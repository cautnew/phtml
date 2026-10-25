<?php

namespace CN\PHTML\BS;

class TABLE extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('table', 'table', ...$args); }

  public function striped(bool $striped = true): self
  {
    $this->toggleClass('table-striped', $striped);
    return $this;
  }

  public function bordered(bool $bordered = true): self
  {
    $this->toggleClass('table-bordered', $bordered);
    return $this;
  }

  public function hover(bool $hover = true): self
  {
    $this->toggleClass('table-hover', $hover);
    return $this;
  }

}
