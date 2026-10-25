<?php

namespace CN\PHTML\BS;

class MENU extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'menu', ...$args); }

  public function translucent(bool $translucent = true): self
  {
    $this->toggleClass('menu-translucent', $translucent);
    return $this;
  }

  public function show(bool $show = true): self
  {
    $this->toggleClass('show', $show);
    return $this;
  }
}
