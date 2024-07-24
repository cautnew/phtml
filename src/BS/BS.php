<?php

namespace PHTML\BS;

use PHTML\TAG;

class BS extends TAG
{
  private array $fixedClasses;

  public function __toString(): string
  {
    return $this->render();
  }

  public function render(): string
  {
    $this->loadFixedClasses();
    return parent::render();
  }

  private function loadFixedClasses(): void
  {
    if (!isset($this->fixedClasses)) {
      return;
    }

    foreach ($this->fixedClasses as $class) {
      $this->addClass($class);
    }
  }

  public function setFixedClasses(array $classes): self
  {
    if (!isset($this->fixedClasses)) {
      $this->fixedClasses = $classes;
    }

    return $this;
  }

  public static function row(...$args): ROW
  {
    return new ROW(...$args);
  }

  public static function col(): COL
  {
    return new COL();
  }

  public static function listGroup(...$args): LIST_GROUP
  {
    return new LIST_GROUP(...$args);
  }
}
