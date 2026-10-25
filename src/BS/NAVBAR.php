<?php

namespace CN\PHTML\BS;

class NAVBAR extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('nav', 'navbar', ...$args); }

  public function expand(string $breakpoint = 'lg'): self
  {
    $this->addClass($breakpoint . ':navbar-expand');
    return $this;
  }
}
