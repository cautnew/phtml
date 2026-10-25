<?php

namespace CN\PHTML\BS;

class LIST_GROUP_ITEM extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('li', 'list-group-item', ...$args); }

  public function active(bool $active = true): self
  {
    parent::active($active);
    $this->aria('current', $active ? 'true' : 'false');
    return $this;
  }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'theme') . '-' . $color);
    return $this;
  }
}
