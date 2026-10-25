<?php

namespace CN\PHTML\BS;

class TOAST_CONTAINER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'toast-container', ...$args); }
}
