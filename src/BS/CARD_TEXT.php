<?php

namespace CN\PHTML\BS;

class CARD_TEXT extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('p', 'card-text', ...$args); }
}
