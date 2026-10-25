<?php

namespace CN\PHTML\BS;

class NAVBAR_BRAND extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('a', 'navbar-brand', ...$args); }
}
