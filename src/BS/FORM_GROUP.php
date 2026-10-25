<?php

namespace CN\PHTML\BS;

class FORM_GROUP extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'form-group', ...$args); }
}
