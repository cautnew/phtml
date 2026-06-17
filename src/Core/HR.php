<?php

namespace PHTML\Core;

/**
 * Class HR
 */
class HR extends NONCONTENTTAG
{
    public function __construct(?string $class = null, ...$args)
    {
        $this->setTagType('hr');

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
