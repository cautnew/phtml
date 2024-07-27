<?php

namespace PHTML;

/**
 * Class I
 */
class I extends TAG
{
    public function __construct(?string $class = null, ...$args)
    {
        $this->setTagType('i');
        $this->setAllowContent(false);

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
