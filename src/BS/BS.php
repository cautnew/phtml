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

  public static function row(?string $class = null, ?string $id = null, ?string $html = null, ...$args): ROW
  {
    return new ROW($class, $id, $html, ...$args);
  }

  public static function col(int $size = 0, int $onXs = 0, int $onSm = 0, int $onMd = 0, int $onLg = 0, int $onXl = 0, int $onXxl = 0, ?string $class = null, ?string $id = null, ?string $html = null, ...$args): COL
  {
    return new COL($size, $onXs, $onSm, $onMd, $onLg, $onXl, $onXxl, $class, $id, $html, ...$args);
  }

  public static function listGroup(...$args): LIST_GROUP
  {
    return new LIST_GROUP(...$args);
  }

  public static function alert(?string $class = null, ?string $id = null, ?string $color = null, ?string $html = null, ...$args): ALERT
  {
    return new ALERT($class, $id, $color, $html, ...$args);
  }
}
