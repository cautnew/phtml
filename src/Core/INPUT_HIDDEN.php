<?php

namespace PHTML\Core;

/**
 * Class INPUT_HIDDEN
 */
class INPUT_HIDDEN extends INPUT
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'hidden', ...$args);
    }
}
