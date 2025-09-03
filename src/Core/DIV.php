<?php

namespace PHTML\Core;

/**
 * Class DIV
 */
class DIV extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, ...$args)
    {
        $this->setTagType('div');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
