<?php

namespace PHTML\Core;

/**
 * Class TBODY
 */
class TBODY extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, ...$args)
    {
        $this->setTagType('tbody');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
