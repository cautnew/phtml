<?php

namespace CN\PHTML\BS;

class CONTAINER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'container', ...$args); }
}
