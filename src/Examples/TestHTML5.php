<?php

use CN\PHTML\Core\DIV;
use CN\PHTML\Core\TAG;
use CN\PHTML\Templates\HTML5;

require __DIR__ . '/../../vendor/autoload.php';

$page = new HTML5();
$page->setPageTitle('Testando o título');

$div = new DIV('veio');

$page->appendToBody($div);

$div->setParameter('foi', 'duas');

$page->appendToBody($div);

$page->appendToBody(clone $div);
$page->appendToBody(TAG::input('input', 'input', 'input', 'input', 'input'));

$div->setParameter('voltou', 'três');

echo $page;
