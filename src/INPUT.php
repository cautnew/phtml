<?php

namespace PHTML;

/**
 * Class INPUT
 */
class INPUT extends TAG
{
    public function __construct(?string $type = null, ?string $class = null, ?string $id = null, ?string $name = null, mixed $value = null, ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

        $arguments = $args ?? [];

        if (!empty($type)) {
            $arguments['type'] = $type;
        }

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($id)) {
            $arguments['id'] = $id;
        }

        if (!empty($name)) {
            $arguments['name'] = $name;
        }

        if (!empty($value)) {
            $arguments['value'] = $value;
        }

        $this->setParameters($arguments);
    }
}
