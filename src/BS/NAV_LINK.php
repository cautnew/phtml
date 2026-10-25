<?php

namespace CN\PHTML\BS;

class NAV_LINK extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('a', 'nav-link', ...$args); }

  public function active(bool $active = true): self
  {
    parent::active($active);
    $this->aria('current', $active ? 'page' : 'false');
    return $this;
  }
}
