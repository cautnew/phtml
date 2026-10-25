<?php

namespace CN\PHTML\BS;

class FORM_RANGE extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('input', 'form-range', ...$args);
    $this->setAllowContent(false);
    $this->setParameter('type', 'range');
  }
}
