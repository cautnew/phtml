<?php

namespace CN\PHTML\BS;

class DIALOG_TITLE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('h1', 'dialog-title', ...$args); }
}
