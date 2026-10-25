<?php

namespace CN\PHTML\BS;

class NAVBAR_TOGGLER extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('button', 'navbar-toggler', ...$args);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'button');
    }
  }
}
