<?php

namespace CN\PHTML\BS;

class CARD_SUBTITLE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('h6', 'card-subtitle', ...$args); }
}
