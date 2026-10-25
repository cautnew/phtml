<?php

namespace CN\PHTML\BS;

class FORM_SWITCH extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('div', 'switch', ...$args); }

  public function control(...$args): SWITCH_INPUT
  {
    $input = new SWITCH_INPUT(...$args);
    $this->append($input);
    return $input;
  }
}
