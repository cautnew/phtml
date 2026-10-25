<?php

namespace CN\PHTML\BS;

class DIALOG_BODY extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'dialog-body', ...$args); }
}
