<?php

namespace PHTML;

/**
 * Class HR
 */
class HR extends TAG
{
    public function __construct()
    {
        $this->setTagType('hr');
        $this->setAllowParameter(false);
        $this->setAllowContent(false);
    }
}
