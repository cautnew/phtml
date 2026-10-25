<?php

namespace CN\PHTML\BS;

class PROGRESS extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('div', 'progress', ...$args);
    $this->setParameter('role', 'progressbar');
    $this->aria('valuemin', '0')->aria('valuemax', '100')->aria('valuenow', '0');
  }

  public function value(int $value): self
  {
    $this->aria('valuenow', (string) max(0, min(100, $value)));
    return $this;
  }
}
