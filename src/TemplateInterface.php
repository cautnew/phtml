<?php

namespace CN\PHTML;

use CN\PHTML\Core\BODY;
use CN\PHTML\Core\HEAD;
use CN\PHTML\Core\HTML;

interface TemplateInterface
{
    public function html(): HTML;

    public function head(): HEAD;

    public function body(): BODY;

    public function render(): string;
}
