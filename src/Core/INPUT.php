<?php

namespace CN\PHTML\Core;

/**
 * Class INPUT
 *
 * Represents the <input> tag (void element). See INPUT_TEXT, INPUT_HIDDEN
 * and INPUT_SUBMIT for typed shortcuts.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input
 */
class INPUT extends NONCONTENTTAG
{
    /**
     * Create a new INPUT tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $value Initial value.
     * @param string|null $type Input type (text, email, number, checkbox...).
     * @param mixed ...$args Extra attributes in "name => value" form (e.g. placeholder).
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ?string $type = 'text', ...$args)
    {
        $this->setTagType('input');

        $this->setParameter('type', $type);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }

    /**
     * Mark (or unmark) the field as required.
     */
    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }

    /**
     * Disable (or enable) the field.
     */
    public function disabled(bool $disabled = true): self
    {
        $this->setParameter('disabled', $disabled);

        return $this;
    }

    /**
     * Make the field read-only.
     */
    public function readonly(bool $readonly = true): self
    {
        $this->setParameter('readonly', $readonly);

        return $this;
    }
}
