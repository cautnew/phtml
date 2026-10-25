<?php

namespace CN\PHTML\Core;

/**
 * Class INPUT_SUBMIT
 *
 * Shortcut for <input type="submit">.
 */
class INPUT_SUBMIT extends INPUT
{
    /**
     * Create a new INPUT SUBMIT TYPE tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param mixed $value Button label.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'submit', ...$args);
    }
}
