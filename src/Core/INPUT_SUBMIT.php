<?php

namespace PHTML\Core;

/**
 * Class INPUT_SUBMIT
 */
class INPUT_SUBMIT extends INPUT
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'submit', ...$args);
    }
}
