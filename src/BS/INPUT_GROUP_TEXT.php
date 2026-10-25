<?php

namespace CN\PHTML\BS;

class INPUT_GROUP_TEXT extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('span', 'input-group-text', ...$args); }
}
