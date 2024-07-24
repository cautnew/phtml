<?php

namespace PHTML;

/**
 * Class FORM
 */
class FORM extends TAG
{
    public function __construct(?string $class = null, ?string $action = null, ?string $method = null, ?string $id = null, mixed $append = null, ...$args)
    {
        $this->setTagType('form');

        $arguments = $args ?? [];

        if (!empty($class)) {
            $arguments['class'] = $class;
        }

        if (!empty($action)) {
            $arguments['action'] = $action;
        }

        if (!empty($method)) {
            $arguments['method'] = $method;
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
