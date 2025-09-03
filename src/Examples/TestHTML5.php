<?php

use PHTML\Core\DIV;
use PHTML\Templates\HTML5;

require __DIR__ . '/../../../../autoload.php';

$page = new HTML5();
$page->setPageTitle('Testando o título');

$div = new DIV('veio');

$page->appendToBody($div);

$div->setParameter('foi', 'duas');

$page->appendToBody($div);

$page->appendToBody(clone $div);

$div->setParameter('voltou', 'três');

echo $page;
