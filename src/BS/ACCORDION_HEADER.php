<?php

namespace CN\PHTML\BS;

class ACCORDION_HEADER extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('summary', 'accordion-header', ...$args); }
}
