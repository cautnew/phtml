<?php

namespace PHTML\BS;

class ROW extends BS
{
  public function __construct(?string $class = null, ?string $id = null, ?string $html = null, ...$args)
  {
    $this->setTagType('div');

    $this->setParameter('class', $class);
    $this->setParameter('id', $id);
    $this->setParameter('html', $html);
    $this->setParameters($args);
  }

  public function __toString(): string
  {
    return $this->render();
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->clearClassList();
    $this->addClass('row');

    return parent::render();
  }
}
