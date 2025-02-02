<?php

namespace PHTML;

/**
 * Class TR
 */
class TR extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, ...$args)
    {
        $this->setTagType('tr');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
