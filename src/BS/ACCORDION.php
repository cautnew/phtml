<?php

namespace CN\PHTML\BS;

class ACCORDION extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'accordion', ...$args); }

  public function flush(bool $flush = true): self
  {
    return $this->toggleModifier('accordion-flush', $flush);
  }

  public function gap(bool $gap = true): self
  {
    return $this->toggleModifier('accordion-gap', $gap);
  }

  private function toggleModifier(string $class, bool $enabled): self
  {
    $classes = $this->getClassList();
    if ($enabled && !in_array($class, $classes, true)) {
      $classes[] = $class;
    } elseif (!$enabled) {
      $classes = array_values(array_filter($classes, static fn(string $item): bool => $item !== $class));
    }
    $this->setClassList($classes);
    return $this;
  }
}
