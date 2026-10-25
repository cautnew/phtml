<?php

namespace CN\PHTML\BS;

class CARD_HEADER extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('div', 'card-header', ...$args);
  }
}
