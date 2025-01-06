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

  public static function iconCircleCheck(?string $class = null, ...$args): CIRCLE_CHECK
  {
    return new CIRCLE_CHECK($class, ...$args);
  }

  public static function iconCircleXMark(?string $class = null, ...$args): CIRCLE_XMARK
  {
    return new CIRCLE_XMARK($class, ...$args);
  }

  public static function iconCircle($class = null, ...$args): CIRCLE
  {
    return new CIRCLE($class, ...$args);
  }

  public static function iconCopy(?string $class = null, ...$args): COPY
  {
    return new COPY($class, ...$args);
  }

  public static function iconCopyright(?string $class = null, ...$args): COPYRIGHT
  {
    return new COPYRIGHT($class, ...$args);
  }

  public static function iconDefEdit(?string $class = null, ...$args): DEF_EDIT
  {
    return new DEF_EDIT($class, ...$args);
  }

  public static function iconDefCopy(?string $class = null, ...$args): DEF_COPY
  {
    return new DEF_COPY($class, ...$args);
  }

  public static function iconDefView(?string $class = null, ...$args): DEF_VIEW
  {
    return new DEF_VIEW($class, ...$args);
  }

  public static function iconFloppyDisk(?string $class = null, ...$args): FLOPPY_DISK
  {
    return new FLOPPY_DISK($class, ...$args);
  }

  public static function iconHeart(?string $class = null, ...$args): HEART
  {
    return new HEART($class, ...$args);
  }

  public static function iconNewspaper(?string $class = null, ...$args): NEWSPAPER
  {
    return new NEWSPAPER($class, ...$args);
  }

  public static function iconPenToSquare(?string $class = null, ...$args): PEN_TO_SQUARE
  {
    return new PEN_TO_SQUARE($class, ...$args);
  }

  public static function iconPlus(?string $class = null, ...$args): PLUS
  {
    return new PLUS($class, ...$args);
  }

  public static function iconTable(?string $class = null, ...$args): TABLE
  {
    return new TABLE($class, ...$args);
  }

  public static function iconTrash(?string $class = null, ...$args): TRASH
  {
    return new TRASH($class, ...$args);
  }

  public static function iconUsers(?string $class = null, ...$args): USERS
  {
    return new USERS($class, ...$args);
  }
}
