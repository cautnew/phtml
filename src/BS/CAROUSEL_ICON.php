<?php

namespace CN\PHTML\BS;

class CAROUSEL_ICON extends BS_ELEMENT
{
  public function __construct(string $direction = 'next', ...$args)
  {
    parent::__construct('span', 'carousel-icon-' . $direction, ...$args);
    $this->aria('hidden', 'true');
  }
}
