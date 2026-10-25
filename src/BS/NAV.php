<?php

namespace CN\PHTML\BS;

class NAV extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('ul', 'nav', ...$args); }

  public function tabs(bool $tabs = true): self
  {
    $this->toggleClass('nav-tabs', $tabs);
    $this->toggleClass('nav-pills', false);
    return $this;
  }

  public function pills(bool $pills = true): self
  {
    $this->toggleClass('nav-pills', $pills);
    $this->toggleClass('nav-tabs', false);
    return $this;
  }

  public function fill(bool $fill = true): self
  {
    $this->toggleClass('nav-fill', $fill);
    return $this;
  }

  public function justified(bool $justified = true): self
  {
    $this->toggleClass('nav-justified', $justified);
    return $this;
  }
}
