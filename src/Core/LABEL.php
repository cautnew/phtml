<?php

namespace PHTML\Core;

/**
 * Class LABEL
 */
class LABEL extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $for = null, ?string $html = null, ...$args)
    {
        $this->setTagType('label');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('for', $for);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
