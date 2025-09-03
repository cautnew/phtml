<?php

namespace PHTML\TW;

use PHTML\Core\TAG;

/*
 * Tailwind CSS
 */
class TW extends TAG
{
  private array $fixedClasses;
  private array $classesAvailable;
  private array $classesOnDarkMode;

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
}
