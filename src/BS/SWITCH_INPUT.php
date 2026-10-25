<?php

namespace CN\PHTML\BS;

class SWITCH_INPUT extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('input', '', ...$args);
    $this->setAllowContent(false);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'checkbox');
    }
    $this->setAttribute('role', 'switch');
    $this->setParameter('switch', true);
  }
}
