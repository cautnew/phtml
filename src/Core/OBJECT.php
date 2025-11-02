<?php

namespace PHTML\Core;

/**
 * Class OBJECT
 */
class OBJECT extends TAG
{
    public function __construct(...$args)
    {
        $this->setTagType('object');
        $this->setParameters($args);
    }
}
