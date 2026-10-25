<?php

namespace CN\PHTML\Tests;

use CN\PHTML\ArrayTAG;
use CN\PHTML\Core\A;
use CN\PHTML\Core\CAPTION;
use CN\PHTML\Core\DIV;
use CN\PHTML\Core\HTML;
use CN\PHTML\Core\INPUT_TEXT;
use CN\PHTML\Core\OPTION;
use CN\PHTML\Core\TAG;
use CN\PHTML\Exceptions\ParametersNotAllowedException;
use PHPUnit\Framework\TestCase;

class TagBehaviourTest extends TestCase
{
    public function testClassIdAndContent(): void
    {
        $div = new DIV('main box', 'box-1', 'Hello');

        $this->assertSame('<div class="main box" id="box-1">Hello</div>', (string) $div);
    }

    public function testClassesAreNotDuplicated(): void
    {
        $div = TAG::div()->addClass('a')->addClass('a b');

        $this->assertSame('<div class="a b"></div>', (string) $div);
    }

    public function testNestedTagsAndStrings(): void
    {
        $div = TAG::div(id: 'x');
        $div->append(TAG::p(html: 'one'))->append('two');

        $this->assertSame('<div id="x"><p>one</p>two</div>', (string) $div);
    }

    public function testArrayTagAppendsEveryElement(): void
    {
        $ul = TAG::ul()->append(new ArrayTAG([TAG::li(html: 'a'), TAG::li(html: 'b')]));

        $this->assertSame('<ul><li>a</li><li>b</li></ul>', (string) $ul);
    }

    public function testDataAriaBooleanAndStyleAttributes(): void
    {
        $input = (new INPUT_TEXT('c', 'i', 'n', 'Type here'))
            ->required()
            ->data('role', 'main')
            ->aria('label', 'Name')
            ->setStyle('color', 'red');

        $this->assertSame(
            '<input class="c" id="i" name="n" type="text" placeholder="Type here" style="color: red;" data-role="main" aria-label="Name" required />',
            (string) $input
        );
    }

    public function testNestedDataAndAriaArrays(): void
    {
        $div = TAG::div()->setDataAttributes(['a' => ['b' => '1']])->setAriaAttributes(['x' => ['y' => '2']]);

        $this->assertSame('<div data-a-b="1" aria-x-y="2"></div>', (string) $div);
    }

    public function testAppendBeforeAndAfterAreRenderedOutsideTheTag(): void
    {
        $div = TAG::div(html: 'x')->appendBefore('<!-- a -->')->appendAfter('<!-- b -->');

        $this->assertSame('<!-- a --><div>x</div><!-- b -->', (string) $div);
    }

    public function testDisallowedStyleThrows(): void
    {
        $this->expectException(ParametersNotAllowedException::class);

        TAG::div()->setStyle('not-a-property', '1');
    }

    public function testImageIsAVoidTag(): void
    {
        $this->assertSame('<img class="logo" src="a.png" alt="Logo" />', (string) TAG::img('a.png', 'Logo', 'logo'));
    }

    public function testLinkTargetBlankAddsRel(): void
    {
        $a = (new A('/home', 'Home'))->target('_blank');

        $this->assertSame('<a href="/home" target="_blank" rel="noopener noreferrer">Home</a>', (string) $a);
    }

    public function testOptionHelpers(): void
    {
        $option = (new OPTION('1', 'One'))->selected();

        $this->assertSame('<option value="1" selected>One</option>', (string) $option);
    }

    public function testSelectWithOptions(): void
    {
        $select = TAG::select(name: 'n')->append(TAG::option('1', 'One'))->append(TAG::option('2', 'Two'));

        $this->assertSame('<select name="n"><option value="1">One</option><option value="2">Two</option></select>', (string) $select);
    }

    public function testTableStructure(): void
    {
        $table = TAG::table()
            ->append(new CAPTION(side: 'bottom', html: 'Sales'))
            ->append(TAG::thead()->append(TAG::tr()->append(TAG::th(html: 'Name'))))
            ->append(TAG::tbody()->append(TAG::tr()->append(TAG::td(html: 'Ann'))));

        $this->assertSame(
            '<table><caption style="caption-side: bottom;">Sales</caption><thead><tr><th>Name</th></tr></thead><tbody><tr><td>Ann</td></tr></tbody></table>',
            (string) $table
        );
    }

    public function testTitleKeepsASingleText(): void
    {
        $title = TAG::tagTitle('First');
        $title->setTitle('Second');

        $this->assertSame('<title>Second</title>', (string) $title);
    }

    public function testHtmlRendersDoctype(): void
    {
        $html = (new HTML())->setLang('en');

        $this->assertSame("<!DOCTYPE html>\n<html lang=\"en\"></html>", (string) $html);
    }

    public function testMetaUsesContentAttribute(): void
    {
        $this->assertSame('<meta name="viewport" content="width=device-width" />', (string) TAG::meta('viewport', 'width=device-width'));
    }

    public function testFormAndLabel(): void
    {
        $form = TAG::form(action: '/save', method: 'post')
            ->append(TAG::label(for: 'n', html: 'Name'))
            ->append(new INPUT_TEXT(id: 'n', name: 'n'));

        $this->assertSame(
            '<form action="/save" method="post"><label for="n">Name</label><input id="n" name="n" type="text" /></form>',
            (string) $form
        );
    }
}
