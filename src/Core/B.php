<?php

namespace PHTML\Core;

/**
 * Class B
 */
class B extends TAG
{
    public function __construct(?string $class = null, ?string $html = null, ...$args)
    {
        $this->setTagType('b');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
