<?php

namespace PHTML\BS;

class CARD_HEADER extends BS
{
  public function __construct(...$args)
  {
    $this->setTagType('div');
    $this->setParameters($args);
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->addClass('card-header');

    return parent::render();
  }
}
