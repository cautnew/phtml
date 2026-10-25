<?php

namespace CN\PHTML\BS;

class TABLE_RESPONSIVE extends BS_ELEMENT
{
  public function __construct(string $breakpoint = '', ...$args)
  {
    parent::__construct('div', 'table-responsive' . ($breakpoint === '' ? '' : '-' . $breakpoint), ...$args);
  }
}
