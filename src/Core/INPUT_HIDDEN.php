<?php

namespace CN\PHTML\Core;

/**
 * Class INPUT_HIDDEN
 *
 * Shortcut for <input type="hidden">.
 */
class INPUT_HIDDEN extends INPUT
{
    /**
     * Create a new INPUT HIDDEN TYPE tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $value Hidden value.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'hidden', ...$args);
    }
}
