<?php

namespace CN\PHTML\BS;

class FORM_LABEL extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('label', 'form-label', ...$args); }
}
