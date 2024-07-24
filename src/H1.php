<?php

namespace PHTML;

/**
 * Class H1
 */
class H1 extends TAG
{
    public function __construct(?string $class = null, mixed $append = null, ...$args)
    {
        $this->setTagType('h1');

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
