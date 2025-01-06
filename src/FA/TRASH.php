<?php

namespace PHTML\FA;

class TRASH extends FA
{
  public function __construct(?string $class = null, ...$args)
  {
    $this->setTagType('i');
    $this->setParameter('class', $class);
    $this->setParameters($args);
  }

  public function __toString()
  {
    return $this->render();
  }

  public function render(): string
  {
    $this->setFixedClasses($this->getClassList());
    $this->clearClassList();
    $this->addClass('fa-solid fa-trash');

    return parent::render();
  }
}
