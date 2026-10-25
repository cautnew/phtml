<?php

namespace CN\PHTML\BS;

class BREADCRUMB extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('ol', 'breadcrumb', ...$args); }
}
