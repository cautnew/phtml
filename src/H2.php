<?php

namespace PHTML;

/**
 * Class H2
 */
class H2 extends TAG
{
    public function __construct(?string $class = null, mixed $append = null, ...$args)
    {
        $this->setTagType('h2');

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
