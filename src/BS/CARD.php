<?php

namespace PHTML\BS;

class CARD extends BS
{
  public function __construct(...$args)
  {
    $this->setTagType('div');
    $this->setParameters($args);
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->addClass('card');

    return parent::render();
  }
}
