<?php

namespace PHTML\FA;

use PHTML\TAG;

class FA extends TAG
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

  public static function iconCircleCheck(?string $class = null, ...$args): ICON_CIRCLE_CHECK
  {
    return new ICON_CIRCLE_CHECK($class, ...$args);
  }

  public static function iconCircleXMark(?string $class = null, ...$args): ICON_CIRCLE_XMARK
  {
    return new ICON_CIRCLE_XMARK($class, ...$args);
  }

  public static function iconCircle($class = null, ...$args): ICON_CIRCLE
  {
    return new ICON_CIRCLE($class, ...$args);
  }

  public static function iconDefEdit(?string $class = null, ...$args): ICON_DEF_EDIT
  {
    return new ICON_DEF_EDIT($class, ...$args);
  }

  public static function iconFloppyDisk(?string $class = null, ...$args): ICON_FLOPPY_DISK
  {
    return new ICON_FLOPPY_DISK($class, ...$args);
  }

  public static function iconHeart(?string $class = null, ...$args): ICON_HEART
  {
    return new ICON_HEART($class, ...$args);
  }

  public static function iconNewspaper(?string $class = null, ...$args): ICON_NEWSPAPER
  {
    return new ICON_NEWSPAPER($class, ...$args);
  }

  public static function iconPenToSquare(?string $class = null, ...$args): ICON_PEN_TO_SQUARE
  {
    return new ICON_PEN_TO_SQUARE($class, ...$args);
  }

  public static function iconPlus(?string $class = null, ...$args): ICON_PLUS
  {
    return new ICON_PLUS($class, ...$args);
  }

  public static function iconTable(?string $class = null, ...$args): ICON_TABLE
  {
    return new ICON_TABLE($class, ...$args);
  }

  public static function iconTrash(?string $class = null, ...$args): ICON_TRASH
  {
    return new ICON_TRASH($class, ...$args);
  }

  public static function iconUsers(?string $class = null, ...$args): ICON_USERS
  {
    return new ICON_USERS($class, ...$args);
  }
}
