<?php

namespace CN\PHTML\BS;

class PAGINATION_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('li', 'page-item', ...$args); }
}
