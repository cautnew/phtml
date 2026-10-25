<?php

namespace CN\PHTML\BS;

class COLLAPSE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'collapse', ...$args); }

  public function horizontal(bool $horizontal = true): self
  {
    $this->toggleClass('collapse-horizontal', $horizontal);
    return $this;
  }
}
