<?php

namespace CN\PHTML\BS;

class INPUT_GROUP extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'input-group', ...$args); }
}
