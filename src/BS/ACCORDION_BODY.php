<?php

namespace CN\PHTML\BS;

class ACCORDION_BODY extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'accordion-body', ...$args); }
}
