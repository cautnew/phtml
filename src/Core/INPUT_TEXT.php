<?php

namespace CN\PHTML\Core;

/**
 * Class INPUT_TEXT
 *
 * Shortcut for <input type="text">.
 */
class INPUT_TEXT extends INPUT
{
    /**
     * Create a new INPUT TEXT TYPE tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $placeholder Hint displayed while the field is empty.
     * @param string|null $value Initial value.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $placeholder = null, ?string $value = null, ...$args)
    {
        parent::__construct($class, $id, $name, $value, 'text', ...$args);
        $this->setParameter('placeholder', $placeholder);
    }
}
