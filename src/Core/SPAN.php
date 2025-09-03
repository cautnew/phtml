<?php

namespace PHTML\Core;

/**
 * Class SPAN
 */
class SPAN extends TAG
{
    public function __construct(?string $class = null, ?string $html = null, ...$args)
    {
        $this->setTagType('span');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
