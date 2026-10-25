<?php

namespace CN\PHTML\BS;

class FORM_FEEDBACK extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'invalid-feedback', ...$args); }

  public function valid(bool $valid = true): self
  {
    $this->toggleClass('valid-feedback', $valid);
    $this->toggleClass('invalid-feedback', !$valid);
    return $this;
  }
}
