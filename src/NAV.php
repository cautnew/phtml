<?php

namespace PHTML;

/**
 * Class NAV
 */
class NAV extends TAG
{
    public function __construct(...$args)
    {
        $this->setTagType('nav');
        $this->setParameters($args);
    }
}
