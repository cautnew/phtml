<?php

namespace CN\PHTML\Tests;

use CN\PHTML\ArrayTAG;
use CN\PHTML\Core\OPTION;
use CN\PHTML\Core\TAG;
use CN\PHTML\Core\TD;
use CN\PHTML\Core\TH;
use CN\PHTML\Lists\HEAD_LIST;
use CN\PHTML\Lists\OL_LIST;
use CN\PHTML\Lists\SELECT_LIST;
use CN\PHTML\Lists\TABLE_LIST;
use CN\PHTML\Lists\TBODY_LIST;
use CN\PHTML\Lists\THEAD_LIST;
use CN\PHTML\Lists\TR_LIST;
use CN\PHTML\Lists\UL_LIST;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ListTagsTest extends TestCase
{
    public static function listClasses(): array
    {
        $cases = [];

        foreach (glob(__DIR__ . '/../src/Lists/*_LIST.php') as $file) {
            $short = basename($file, '.php');
            $cases[$short] = ["CN\\PHTML\\Lists\\{$short}"];
        }

        return $cases;
    }

    #[DataProvider('listClasses')]
    public function testEveryListAcceptsItsChildrenAndRejectsOthers(string $class): void
    {
        $children = $class::allowedChildren();
        $this->assertNotEmpty($children);

        $items = array_map(fn (string $c) => $c === OPTION::class ? new OPTION("v", "t") : new $c(), $children);
        $list = new $class($items);
        $this->assertStringContainsString('</', $list->render());

        $this->expectException(InvalidArgumentException::class);
        new $class([new \stdClass()]);
    }

    #[DataProvider('listClasses')]
    public function testEveryListHasAFactory(string $class): void
    {
        $short = substr(strrchr($class, '\\'), 1);
        $factory = lcfirst(str_replace(' ', '', ucwords(strtolower(str_replace('_', ' ', $short)))));

        $this->assertInstanceOf($class, TAG::$factory());
    }

    public function testUnorderedListRendersItems(): void
    {
        $ul = new UL_LIST([TAG::li(html: 'a'), TAG::li(html: 'b')], class: 'menu');

        $this->assertSame('<ul class="menu"><li>a</li><li>b</li></ul>', (string) $ul);
    }

    public function testOnlyListItemsAreAllowedInLists(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('only accepts LI');

        new OL_LIST([TAG::p(html: 'x')]);
    }

    public function testSelectListAcceptsOptions(): void
    {
        $select = TAG::selectList([TAG::option('1', 'One')], name: 'n');

        $this->assertSame('<select name="n"><option value="1">One</option></select>', (string) $select);
    }

    public function testTableSectionsOnlyAcceptRows(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TBODY_LIST([new TD()]);
    }

    public function testRowsAcceptCellsOnly(): void
    {
        $this->assertSame('<tr><th>H</th><td>D</td></tr>', (string) new TR_LIST([new TH(html: 'H'), new TD(html: 'D')]));

        $this->expectException(InvalidArgumentException::class);
        new TR_LIST([TAG::tr()]);
    }

    public function testFullTable(): void
    {
        $table = new TABLE_LIST([
            new THEAD_LIST([new TR_LIST([new TH(html: 'Name')])]),
            new TBODY_LIST([new TR_LIST([new TD(html: 'Ann')])]),
        ], class: 'table');

        $this->assertSame(
            '<table class="table"><thead><tr><th>Name</th></tr></thead><tbody><tr><td>Ann</td></tr></tbody></table>',
            (string) $table
        );
    }

    public function testItemsCanComeFromAnArrayTag(): void
    {
        $items = new ArrayTAG([TAG::li(html: 'a')]);

        $this->assertSame('<ul><li>a</li></ul>', (string) new UL_LIST($items));
    }

    public function testTypedListFromNewList(): void
    {
        $list = TR_LIST::newList([new TD()]);
        $this->assertCount(1, $list);

        $this->expectException(InvalidArgumentException::class);
        $list[] = TAG::li();
    }

    public function testItemsCanBeAddedLater(): void
    {
        $ul = new UL_LIST();
        $ul->addItem(TAG::li(html: 'late'));

        $this->assertSame('<ul><li>late</li></ul>', (string) $ul);
    }

    public function testHeadListAcceptsMetadataTags(): void
    {
        $head = new HEAD_LIST([TAG::tagTitle('T'), TAG::meta('viewport', 'x')]);

        $this->assertSame('<head><title>T</title><meta name="viewport" content="x" /></head>', (string) $head);
    }
}
