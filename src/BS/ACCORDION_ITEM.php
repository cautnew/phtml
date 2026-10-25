<?php

namespace CN\PHTML\BS;

class ACCORDION_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('details', 'accordion-item', ...$args); }
}
