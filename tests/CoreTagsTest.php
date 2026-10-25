<?php

namespace CN\PHTML\Tests;

use CN\PHTML\Core\NONCONTENTTAG;
use CN\PHTML\Core\TAG;
use CN\PHTML\Exceptions\ContentNotAllowedException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * Smoke tests that run against every tag class found in src/Core.
 */
class CoreTagsTest extends TestCase
{
    /** Classes that are not tags by themselves or need mandatory arguments. */
    private const SKIPPED = ['TAG', 'NONCONTENTTAG', 'OPTION'];

    /** Tags whose class name differs from the HTML tag name. */
    private const TAG_NAMES = [
        'TAG_OBJECT' => 'object',
        'VARIABLE' => 'var',
        'INPUT_TEXT' => 'input',
        'INPUT_HIDDEN' => 'input',
        'INPUT_SUBMIT' => 'input',
    ];

    /** Static factories whose name differs from the lowercase class name. */
    private const FACTORIES = [
        'TAG_OBJECT' => 'tagObject',
        'DATA' => 'tagData',
        'TITLE' => 'tagTitle',
        'COL' => 'tagCol',
        'VARIABLE' => 'variable',
    ];

    public static function tagClasses(): array
    {
        $cases = [];

        foreach (glob(__DIR__ . '/../src/Core/*.php') as $file) {
            $short = basename($file, '.php');
            if (in_array($short, self::SKIPPED, true)) {
                continue;
            }

            $cases[$short] = [$short, self::TAG_NAMES[$short] ?? strtolower($short)];
        }

        return $cases;
    }

    #[DataProvider('tagClasses')]
    public function testEveryTagRendersItsOwnElement(string $short, string $tagName): void
    {
        $class = "CN\\PHTML\\Core\\{$short}";
        $tag = new $class();

        $this->assertInstanceOf(TAG::class, $tag);
        $this->assertSame($tagName, $tag->getTagType());

        if ($tag instanceof NONCONTENTTAG) {
            $this->assertFalse($tag->isAllowContent());
            $this->assertStringStartsWith("<{$tagName}", $tag->render());
            $this->assertStringEndsWith(' />', $tag->render());
        } elseif ($short !== 'HTML') {
            $this->assertStringStartsWith("<{$tagName}", $tag->render());
            $this->assertStringEndsWith("</{$tagName}>", $tag->render());
        }
    }

    #[DataProvider('tagClasses')]
    public function testEveryTagHasAStaticFactory(string $short, string $tagName): void
    {
        if (str_starts_with($short, 'INPUT_')) {
            $this->markTestSkipped('Typed input shortcuts are created with new INPUT_*().');
        }

        $factory = self::FACTORIES[$short] ?? strtolower($short);

        $this->assertTrue(method_exists(TAG::class, $factory), "TAG::{$factory}() is missing");
        $this->assertInstanceOf("CN\\PHTML\\Core\\{$short}", $short === 'TITLE' ? TAG::$factory('') : TAG::$factory());
    }

    public function testVoidTagsRejectContent(): void
    {
        $this->expectException(ContentNotAllowedException::class);

        TAG::br()->append('text');
    }

    public function testNewTagsAreAvailable(): void
    {
        $this->assertSame('<br />', (string) TAG::br());
        $this->assertSame('<wbr />', (string) TAG::wbr());
        $this->assertSame('<pre>x</pre>', (string) TAG::pre(html: 'x'));
        $this->assertSame('<em class="a">x</em>', (string) TAG::em('a', 'x'));
        $this->assertSame('<code>x</code>', (string) TAG::code(html: 'x'));
        $this->assertSame('<var>x</var>', (string) TAG::variable(html: 'x'));
    }
}
