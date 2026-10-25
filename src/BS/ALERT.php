<?php

namespace CN\PHTML\BS;

class ALERT extends BS
{
  private ?CLOSE_BUTTON $closeButton = null;

  public function __construct(?string $class = null, ?string $id = null, ?string $color = null, ?string $html = null, ...$args)
  {
    $this->setTagType('div');

    $this->setParameter('class', $class);
    $this->setParameter('id', $id);
    $this->setParameter('role', 'alert');

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
    $this->addClass('theme-' . $color);

    return $this;
  }

  public function color(string $color): self
  {
    return $this->setColor($color);
  }

  public function heading(...$args): ALERT_HEADING
  {
    $heading = new ALERT_HEADING(...$args);
    $this->append($heading);
    return $heading;
  }

  public function setDismissible(bool $dismissible = true): self
  {
    $buttonIsAppended = $this->closeButton !== null
      && in_array($this->closeButton, $this->getAppendList(), true);
    if ($dismissible && !$buttonIsAppended) {
      $this->closeButton ??= new CLOSE_BUTTON();
      $this->closeButton->setAttribute('data-bs-dismiss', 'alert');
      $this->closeButton->addClass('ms-auto');
      $this->append($this->closeButton);
    } elseif (!$dismissible && $this->closeButton !== null) {
      $children = array_filter(
        $this->getAppendList(),
        fn(mixed $child): bool => $child !== $this->closeButton
      );
      $this->clearAppend();
      foreach ($children as $child) {
        $this->append($child);
      }
      $this->closeButton = null;
    }

    return $this;
  }

  public function dismissible(bool $dismissible = true): self
  {
    return $this->setDismissible($dismissible);
  }
}
