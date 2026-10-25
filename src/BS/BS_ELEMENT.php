<?php

namespace CN\PHTML\BS;

class BS_ELEMENT extends BS
{
  protected string $baseClass;

  public function __construct(string $tagType, string $baseClass, ...$args)
  {
    $this->baseClass = $baseClass;
    $this->setTagType($tagType);
    $this->setParameters($args);
    $this->addClass($baseClass);
  }

  public function variant(string $variant): self
  {
    $this->addClass($this->baseClass . '-' . $variant);
    return $this;
  }

  public function color(string $color, ?string $prefix = null): self
  {
    $this->addClass(($prefix ?? 'theme') . '-' . $color);
    return $this;
  }

  public function theme(string $theme): self
  {
    $this->addClass('theme-' . $theme);
    return $this;
  }

  public function size(string $size): self
  {
    $this->addClass($this->baseClass . '-' . $size);
    return $this;
  }

  public function active(bool $active = true): self
  {
    $this->toggleClass('active', $active);
    return $this;
  }

  public function disabled(bool $disabled = true): self
  {
    $this->toggleClass('disabled', $disabled);
    if (in_array($this->getTagType(), ['button', 'fieldset', 'input', 'optgroup', 'option', 'select', 'textarea'], true)) {
      $this->setParameter('disabled', $disabled);
    }
    $this->aria('disabled', $disabled ? 'true' : 'false');
    return $this;
  }

  public function open(bool $open = true): self
  {
    $this->setParameter('open', $open);
    return $this;
  }

  public function show(bool $show = true): self
  {
    $this->toggleClass('show', $show);
    return $this;
  }

  protected function toggleClass(string $class, bool $enabled): void
  {
    $classes = $this->getClassList();
    if ($enabled && !in_array($class, $classes, true)) {
      $classes[] = $class;
    } elseif (!$enabled) {
      $classes = array_values(array_filter($classes, static fn(string $item): bool => $item !== $class));
    }
    $this->setClassList($classes);
  }
}
