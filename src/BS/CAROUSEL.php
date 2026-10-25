<?php

namespace CN\PHTML\BS;

class CAROUSEL extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'carousel', ...$args); }

  public function slide(bool $slide = true): self
  {
    $this->toggleClass('slide', $slide);
    return $this;
  }

  public function fade(bool $fade = true): self
  {
    $this->toggleClass('carousel-fade', $fade);
    return $this;
  }
}
