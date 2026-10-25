<?php

namespace CN\PHTML\BS;

class PAGINATION extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('ul', 'pagination', ...$args); }
}
