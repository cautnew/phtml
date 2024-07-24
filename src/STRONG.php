<?php

namespace PHTML;

/**
 * Class STRONG
 */
class STRONG extends TAG
{
    public function __construct(?string $class = null, ...$args)
    {
        $this->setTagType('strong');

        $arguments = $args ?? [];
        $arguments['class'] = $class;

        $this->setParameters($arguments);
    }
}
