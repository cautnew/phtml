<?php

namespace CN\PHTML\BS;

class LIST_GROUP_LINK extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('a', 'list-group-item', ...$args);
    $this->addClass('list-group-item-action');
  }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'theme') . '-' . $color);
    return $this;
  }
}
