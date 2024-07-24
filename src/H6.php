<?php

namespace PHTML;

/**
 * Class H6
 */
class H6 extends TAG
{
    public function __construct(?string $class = null, mixed $append = null, ...$args)
    {
        $this->setTagType('h6');

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
