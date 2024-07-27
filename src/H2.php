<?php

namespace PHTML;

/**
 * Class H2
 */
class H2 extends TAG
{
    public function __construct(?string $class = null, ?string $html = null, ...$args)
    {
        $this->setTagType('h2');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
