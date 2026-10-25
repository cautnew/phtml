<?php

namespace CN\PHTML\BS;

class SCROLLSPY extends BS_ELEMENT
{
  public function __construct(string $tagType = 'div', ...$args)
  {
    parent::__construct($tagType, '', ...$args);
    $this->setAttribute('data-bs-spy', 'scroll');
  }
}
