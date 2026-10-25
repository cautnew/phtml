<?php

namespace CN\PHTML\BS;

class RADIO extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('input', 'radio', ...$args);
    $this->setAllowContent(false);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'radio');
    }
  }
}
