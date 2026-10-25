<?php

namespace CN\PHTML\BS;

class CLOSE_BUTTON extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('button', 'btn-close', ...$args);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'button');
    }
    if (!isset($this->getAriaAttributes()['label'])) {
      $this->aria('label', 'Close');
    }
  }
}
