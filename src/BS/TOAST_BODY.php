<?php

namespace CN\PHTML\BS;

class TOAST_BODY extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'toast-body', ...$args); }
}
