<?php

namespace PHTML\Core;

/**
 * Class LEGEND
 */
class LEGEND extends TAG
{
    public function __construct(?string $class = null, ?string $html = null, ...$args)
    {
        $this->setTagType('legend');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
