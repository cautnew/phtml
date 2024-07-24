<?php

namespace PHTML;

/**
 * Class TEXTAREA
 */
class TEXTAREA extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $placeholder = null, mixed $append = null, ...$args)
    {
        $this->setTagType('textarea');

        $arguments = $args ?? [];

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($id)) {
            $arguments['id'] = $id;
        }

        if (!empty($name)) {
            $arguments['name'] = $name;
        }

        if (!empty($placeholder)) {
            $arguments['placeholder'] = $placeholder;
        }

        if (!empty($append)) {
            $arguments['append'] = $append;
        }

        $this->setParameters($arguments);
    }
}
