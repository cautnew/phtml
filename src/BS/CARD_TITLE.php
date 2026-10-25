<?php

namespace CN\PHTML\BS;

class CARD_TITLE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('h5', 'card-title', ...$args); }
}
