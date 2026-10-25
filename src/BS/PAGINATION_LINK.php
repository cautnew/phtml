<?php

namespace CN\PHTML\BS;

class PAGINATION_LINK extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('a', 'page-link', ...$args); }
}
