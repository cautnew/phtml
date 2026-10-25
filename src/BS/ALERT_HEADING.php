<?php

namespace CN\PHTML\BS;

class ALERT_HEADING extends BS_ELEMENT
{
  public function __construct(...$args) { parent::__construct('h4', 'alert-heading', ...$args); }
}
