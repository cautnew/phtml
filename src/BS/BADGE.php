<?php

namespace CN\PHTML\BS;

class BADGE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('span', 'badge', ...$args); }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'theme') . '-' . $color);
    return $this;
  }

  public function subtle(bool $subtle = true): self
  {
    $this->toggleClass('badge-subtle', $subtle);
    return $this;
  }

  public function outline(bool $outline = true): self
  {
    $this->toggleClass('badge-outline', $outline);
    return $this;
  }
}
