<?php

namespace CN\PHTML\BS;

class NAV_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('li', 'nav-item', ...$args); }
}
