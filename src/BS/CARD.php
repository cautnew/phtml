<?php

namespace CN\PHTML\BS;

class CARD extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('div', 'card', ...$args);
  }
}
