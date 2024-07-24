<?php

namespace PHTML;

/**
 * Class LABEL
 */
class LABEL extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $for = null, mixed $append = null, ...$args)
    {
        $this->setTagType('label');

        $arguments = $args ?? [];

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($id)) {
            $arguments['id'] = $id;
        }

        if (!empty($for)) {
            $arguments['for'] = $for;
        }

        if (!empty($append)) {
            $arguments['append'] = $append;
        }

        $this->setParameters($arguments);
    }
}
