<?php

namespace CN\PHTML\BS;

class LIST_GROUP extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('ul', 'list-group', ...$args);
  }

  public function flush(bool $flush = true): self
  {
    $this->toggleClass('list-group-flush', $flush);
    return $this;
  }

  public function numbered(bool $numbered = true): self
  {
    $this->toggleClass('list-group-numbered', $numbered);
    if ($numbered) {
      $this->setTagType('ol');
    } elseif ($this->getTagType() === 'ol') {
      $this->setTagType('ul');
    }
    return $this;
  }

  public function horizontal(string|bool $breakpoint = true): self
  {
    $class = 'list-group-horizontal' . (is_string($breakpoint) ? '-' . $breakpoint : '');
    $this->toggleClass($class, (bool) $breakpoint);
    return $this;
  }
}
