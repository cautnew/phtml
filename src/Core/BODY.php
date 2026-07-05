<?php

namespace CN\PHTML\Core;

/**
 * Class BODY
 */
class BODY extends TAG
{
    public function __construct(...$args)
    {
        $this->setTagType('body');
        $this->setParameters($args);
    }
}
