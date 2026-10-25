<?php

namespace CN\PHTML\BS;

class BUTTON extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('button', 'btn', ...$args);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'button');
    }
  }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'theme') . '-' . $color);
    return $this;
  }

  public function variant(string $variant): self
  {
    foreach (['btn', 'btn-solid', 'btn-outline', 'btn-subtle', 'btn-text'] as $class) {
      $this->toggleClass($class, false);
    }
    $this->addClass(str_starts_with($variant, 'btn-') ? $variant : 'btn-' . $variant);
    return $this;
  }

  public function icon(bool $icon = true): self
  {
    $this->toggleClass('btn-icon', $icon);
    return $this;
  }

  public function pill(bool $pill = true): self
  {
    $this->toggleClass('btn-pill', $pill);
    $this->toggleClass('btn-square', false);
    return $this;
  }

  public function square(bool $square = true): self
  {
    $this->toggleClass('btn-square', $square);
    $this->toggleClass('btn-pill', false);
    return $this;
  }
}
