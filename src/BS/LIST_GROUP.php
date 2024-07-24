<?php

namespace PHTML\BS;

class LIST_GROUP extends BS
{
  private bool $isFlushed = false;

  public function __construct(...$args)
  {
    $this->setTagType('ul');
    $this->setParameters($args);
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->addClass('list-group');

    if ($this->isFlushed) {
      $this->addClass('list-group-flush');
    }

    return parent::render();
  }

  public function flush($isFlushed = true): self
  {
    $this->isFlushed = $isFlushed;
    return $this;
  }
}
