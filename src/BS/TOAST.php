<?php

namespace CN\PHTML\BS;

class TOAST extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('div', 'toast', ...$args);
    $this->setParameter('role', 'alert');
    $this->aria('live', 'assertive')->aria('atomic', 'true');
  }

  public function show(bool $show = true): self
  {
    $this->toggleClass('show', $show);
    $this->aria('live', 'assertive')->aria('atomic', 'true');
    return $this;
  }
}
