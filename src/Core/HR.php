<?php

namespace PHTML\Core;

/**
 * Class HR
 */
class HR extends TAG
{
    public function __construct(?string $class = null, ...$args)
    {
        $this->setTagType('hr');
        $this->setAllowContent(false);

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
