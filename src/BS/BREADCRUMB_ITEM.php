<?php

namespace CN\PHTML\BS;

class BREADCRUMB_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('li', 'breadcrumb-item', ...$args); }

  public function active(bool $active = true): self
  {
    parent::active($active);
    $this->aria('current', $active ? 'page' : 'false');
    return $this;
  }
}
