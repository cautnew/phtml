<?php

namespace CN\PHTML\BS;

class MENU_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('a', 'menu-item', ...$args); }
}
