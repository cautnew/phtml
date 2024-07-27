<?php

namespace PHTML\BS;

class ALERT extends BS
{
  public function __construct(?string $class = null, ?string $id = null, ?string $color = null, ?string $html = null, ...$args)
  {
    $this->setTagType('div');

    $this->setParameter('class', $class);
    $this->setParameter('id', $id);

    if (!empty($color)) {
      $this->setColor($color);
    }

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
    $this->addClass('alert');

    return parent::render();
  }

  public function setColor(string $color): self
  {
    $this->addClass('alert-' . $color);

    return $this;
  }

  public function setDismissible(bool $dismissible = true): self
  {
    if ($dismissible) {
      $this->addClass('alert-dismissible');
    }

    return $this;
  }
}
