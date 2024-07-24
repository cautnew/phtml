<?php

namespace PHTML;

/**
 * Class B
 */
class B extends TAG
{
    public function __construct(?string $class = null, mixed $append = null, ...$args)
    {
        $this->setTagType('b');

        $arguments = $args ?? [];

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($append)) {
            $arguments['append'] = $append;
        }

        $this->setParameters($arguments);
    }
}
