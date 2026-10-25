<?php

namespace CN\PHTML\BS;

class FORM_CONTROL extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('input', 'form-control', ...$args);
    $this->setAllowContent(false);
  }

  public function valid(bool $valid = true): self
  {
    $this->toggleClass('is-valid', $valid);
    if ($valid) {
      $this->toggleClass('is-invalid', false);
    }
    return $this;
  }

  public function invalid(bool $invalid = true): self
  {
    $this->toggleClass('is-invalid', $invalid);
    if ($invalid) {
      $this->toggleClass('is-valid', false);
    }
    return $this;
  }
}
