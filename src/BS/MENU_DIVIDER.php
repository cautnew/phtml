<?php

namespace CN\PHTML\BS;

class MENU_DIVIDER extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('hr', 'menu-divider', ...$args);
    $this->setAllowContent(false);
  }
}
