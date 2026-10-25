<?php

namespace CN\PHTML\BS;

class DRAWER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('dialog', 'drawer', ...$args); }

  public function placement(string $placement = 'start'): self
  {
    $this->addClass('drawer-' . $placement);
    return $this;
  }

  public function instant(bool $instant = true): self
  {
    $this->toggleClass('drawer-instant', $instant);
    return $this;
  }

  public function open(bool $open = true): self
  {
    parent::open($open);
    $this->toggleClass('show', $open);
    return $this;
  }
}
