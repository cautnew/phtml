<?php

namespace PHTML;

/**
 * Class INPUT_SUBMIT
 */
class INPUT_SUBMIT extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $value = null, ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

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

        if (!empty($value)) {
            $arguments['value'] = $value;
        }

        $arguments['type'] = "submit";

        $this->setParameters($arguments);
    }
}
