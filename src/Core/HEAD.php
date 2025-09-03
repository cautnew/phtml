<?php

namespace PHTML\Core;

/**
 * Class HEAD
 */
class HEAD extends TAG
{
    public function __construct(...$args)
    {
        $this->setTagType('head');
        $this->setAllowParameter(false);
        $this->setParameters($args);
    }
}
