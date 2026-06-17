<?php

namespace PHTML\Core;

/**
 * Class SELECT
 */
class SELECT extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, ...$args)
    {
        $this->setTagType('select');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
