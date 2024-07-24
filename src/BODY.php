<?php

namespace PHTML;

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
