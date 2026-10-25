<?php

namespace CN\PHTML\BS;

class CAROUSEL_CONTROL extends BS_ELEMENT
{
  public function __construct(string $direction = 'next', ...$args)
  {
    parent::__construct('button', 'btn-icon', ...$args);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'button');
    }
    $this->direction($direction);
  }

  public function direction(string $direction): self
  {
    $this->setAttribute('data-bs-slide', $direction);
    $this->aria('label', ucfirst($direction));
    return $this;
  }
}
