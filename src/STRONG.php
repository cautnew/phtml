<?php

namespace PHTML;

/**
 * Class STRONG
 */
class STRONG extends TAG
{
    public function __construct(?string $class = null, ...$args)
    {
        $this->setTagType('strong');

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
