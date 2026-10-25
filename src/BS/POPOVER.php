<?php

namespace CN\PHTML\BS;

class POPOVER extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('button', '', ...$args);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'button');
    }
    $this->setAttribute('data-bs-toggle', 'popover');
  }
}
