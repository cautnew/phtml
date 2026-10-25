<?php

namespace CN\PHTML\BS;

class BUTTON_GROUP extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'btn-group', ...$args); }

  public function vertical(bool $vertical = true): self
  {
    $this->toggleClass('btn-group-vertical', $vertical);
    if ($vertical) {
      $this->toggleClass('btn-group', false);
    } else {
      $this->toggleClass('btn-group', true);
    }
    return $this;
  }

  public function size(string $size): self
  {
    $this->addClass('btn-group-' . $size);
    return $this;
  }
}
