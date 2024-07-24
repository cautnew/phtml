<?php

namespace PHTML;

/**
 * Class H5
 */
class H5 extends TAG
{
    public function __construct(?string $class = null, mixed $append = null, ...$args)
    {
        $this->setTagType('h5');

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
