<?php

namespace CN\PHTML\BS;

class SPINNER extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('div', 'spinner-border', ...$args);
    $this->setParameter('role', 'status');
  }

  public function grow(bool $grow = true): self
  {
    $this->toggleClass('spinner-grow', $grow);
    $this->toggleClass('spinner-border', !$grow);
    return $this;
  }

  public function compact(bool $compact = true): self
  {
    $this->toggleClass('spinner-sm', $compact);
    return $this;
  }
}
