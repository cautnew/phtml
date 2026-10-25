<?php

use CN\PHTML\Core\TAG;
use CN\PHTML\Core\TD;
use CN\PHTML\Core\TH;
use CN\PHTML\Core\TR;
use CN\PHTML\Lists\SELECT_LIST;
use CN\PHTML\Lists\TABLE_LIST;
use CN\PHTML\Lists\TR_LIST;
use CN\PHTML\Lists\UL_LIST;

require __DIR__ . '/../../vendor/autoload.php';

// A list built from an array of LI tags.
echo new UL_LIST([
    TAG::li(html: 'First'),
    TAG::li(html: 'Second'),
], class: 'menu'), PHP_EOL;

// Same thing through the static factory.
echo TAG::olList([TAG::li(html: 'One'), TAG::li(html: 'Two')], id: 'steps'), PHP_EOL;

// A SELECT built from OPTION and OPTGROUP tags.
echo TAG::selectList([
    TAG::option('br', 'Brazil')->selected(),
    TAG::option('us', 'United States'),
], name: 'country'), PHP_EOL;

// A full table: rows receive TH/TD cells, sections receive TR rows.
$table = new TABLE_LIST([
    TAG::theadList([
        new TR_LIST([new TH(html: 'Name'), new TH(html: 'Age')]),
    ]),
    TAG::tbodyList([
        new TR_LIST([new TD(html: 'Ann'), new TD(html: '31')]),
        new TR_LIST([new TD(html: 'Bob'), new TD(html: '27')]),
    ]),
], class: 'table');

echo $table, PHP_EOL;

// Anything that is not allowed by the HTML content model is rejected.
try {
    new UL_LIST([TAG::p(html: 'Not a list item')]);
} catch (InvalidArgumentException $e) {
    echo $e->getMessage(), PHP_EOL;
}

// The items can also come from a typed ArrayTAG...
$cells = TR_LIST::newList([new TD(html: 'a'), new TD(html: 'b')]);
echo new TR_LIST($cells), PHP_EOL;

// ...and more items can be added later.
$list = new UL_LIST();
$list->addItem(TAG::li(html: 'late'));
echo $list, PHP_EOL;
