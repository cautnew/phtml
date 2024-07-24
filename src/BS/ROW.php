<?php

namespace PHTML\BS;

class ROW extends BS
{
  public function __construct(?string $class = null, ?string $id = null, mixed $append = null, ...$args)
  {
    $this->setTagType('div');

    $arguments = $args ?? [];

    if (!empty($class)) {
      $arguments['class'] = $class;
    }

    if (!empty($id)) {
      $arguments['id'] = $id;
    }

    if (!empty($append)) {
      $arguments['append'] = $append;
    }

    $this->setParameters($arguments);
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
