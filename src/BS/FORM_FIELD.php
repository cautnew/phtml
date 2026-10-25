<?php

namespace CN\PHTML\BS;

class FORM_FIELD extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'form-field', ...$args); }
}
