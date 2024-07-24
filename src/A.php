<?php

namespace PHTML;

/**
 * Class A
 */
class A extends TAG
{
    public function __construct(?string $href = null, mixed $append = null, ?string $class = null, ?string $id = null, ...$args)
    {
        $this->setTagType('a');

        $arguments = $args ?? [];

        if (!empty($href)) {
            $arguments['href'] = $href;
        }

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
