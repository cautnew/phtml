<?php

namespace PHTML;

use PHTML\Core\BODY;
use PHTML\Core\HEAD;
use PHTML\Core\HTML;

interface TemplateInterface
{
    public function html(): HTML;

    public function head(): HEAD;

    public function body(): BODY;

    public function render(): string;
}
