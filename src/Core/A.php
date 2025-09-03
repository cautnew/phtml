<?php

namespace PHTML\Core;

/**
 * Class A
 */
class A extends TAG
{
    public function __construct(?string $href = null, ?string $html = null, ?string $class = null, ?string $id = null, ...$args)
    {
        $this->setTagType('a');

        $this->setParameter('href', $href);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
