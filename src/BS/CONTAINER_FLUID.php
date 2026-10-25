<?php

namespace CN\PHTML\BS;

class CONTAINER_FLUID extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'container-fluid', ...$args); }
}
