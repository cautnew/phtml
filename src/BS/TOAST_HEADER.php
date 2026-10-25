<?php

namespace CN\PHTML\BS;

class TOAST_HEADER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'toast-header', ...$args); }
}
