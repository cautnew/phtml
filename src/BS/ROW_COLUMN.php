<?php

namespace CN\PHTML\BS;

class ROW_COLUMN extends BS_ELEMENT
{
  public function __construct(int $count = 0, string $breakpoint = '', ...$args)
  {
    parent::__construct('div', 'row', ...$args);
    $this->columns($count, $breakpoint);
  }

  public function columns(int $count, string $breakpoint = ''): self
  {
    $class = ($breakpoint === '' ? '' : $breakpoint . ':') . 'row-cols' . ($count > 0 ? '-' . $count : '');
    $this->addClass($class);
    return $this;
  }
}
