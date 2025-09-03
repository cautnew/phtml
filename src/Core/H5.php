<?php

namespace PHTML\Core;

/**
 * Class H5
 */
class H5 extends TAG
{
    public function __construct(?string $class = null, ?string $html = null, ...$args)
    {
        $this->setTagType('h5');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
