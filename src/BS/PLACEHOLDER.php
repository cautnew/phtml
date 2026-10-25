<?php

namespace CN\PHTML\BS;

class PLACEHOLDER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('span', 'placeholder', ...$args); }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'bg') . '-' . $color);
    return $this;
  }

  public function glow(bool $glow = true): self
  {
    $this->toggleClass('placeholder-glow', $glow);
    return $this;
  }

  public function wave(bool $wave = true): self
  {
    $this->toggleClass('placeholder-wave', $wave);
    return $this;
  }
}
