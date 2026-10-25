<?php

namespace CN\PHTML\BS;

class CARD_IMG extends BS_ELEMENT
{
  public function __construct(...$args)
  {
    parent::__construct('img', 'card-img-top', ...$args);
    $this->setAllowContent(false);
  }

  public function bottom(bool $bottom = true): self
  {
    $this->toggleClass('card-img-bottom', $bottom);
    $this->toggleClass('card-img-top', !$bottom);
    return $this;
  }
}
