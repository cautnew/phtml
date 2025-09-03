<?php

namespace PHTML\Core;

/**
 * Class TABLE
 */
class TABLE extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, ...$args)
    {
        $this->setTagType('table');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
