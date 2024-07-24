<?php

namespace PHTML;

/**
 * Class TD
 */
class TD extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, mixed $append = null, ...$args)
    {
        $this->setTagType('td');

        $arguments = $args ?? [];

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($id)) {
            $arguments['id'] = $id;
        }

        if (!empty($append)) {
            $arguments['append'] = $append;
        }

        $this->setParameters($arguments);
    }
}