<?php

namespace PHTML;

/**
 * Class TH
 */
class TH extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, mixed $append = null, ...$args)
    {
        $this->setTagType('th');

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
