<?php

namespace CN\PHTML\BS;

class PROGRESS_BAR extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'progress-bar', ...$args); }

  public function value(int $value): self
  {
    $value = max(0, min(100, $value));
    $this->setStyle('width', $value . '%');
    return $this;
  }

  public function striped(bool $striped = true): self
  {
    $this->toggleClass('progress-bar-striped', $striped);
    return $this;
  }

  public function animated(bool $animated = true): self
  {
    $this->toggleClass('progress-bar-animated', $animated);
    return $this;
  }
}
