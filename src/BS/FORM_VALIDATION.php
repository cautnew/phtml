<?php

namespace CN\PHTML\BS;

class FORM_VALIDATION extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('form', '', ...$args);
    $this->setDataAttribute('bs-validate', '');
  }

  public function validFeedback(bool $enabled = true): self
  {
    $this->setDataAttribute('bs-validate', $enabled ? 'valid' : '');
    return $this;
  }
}
