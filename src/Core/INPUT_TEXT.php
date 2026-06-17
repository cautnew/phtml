<?php

namespace PHTML\Core;

/**
 * Class INPUT_TEXT
 */
class INPUT_TEXT extends INPUT
{
    /**
     * Create a new INPUT TEXT TYPE tag.
     * @param mixed $class
     * @param mixed $id
     * @param mixed $name
     * @param mixed $placeholder
     * @param mixed $value
     * @param array $args
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $placeholder = null, ?string $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'text', ...$args);
        $this->setParameter('placeholder', $placeholder);
    }
}
