<?php

namespace CN\PHTML\BS;

class NAVBAR_NAV extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('ul', 'navbar-nav', ...$args); }
}
