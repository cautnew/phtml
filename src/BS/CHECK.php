<?php

namespace CN\PHTML\BS;

class CHECK extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('input', 'check', ...$args);
    $this->setAllowContent(false);
    if (!isset($this->getParameters()['type'])) {
      $this->setParameter('type', 'checkbox');
    }
  }
}
