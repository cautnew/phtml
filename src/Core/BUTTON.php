<?php

namespace CN\PHTML\Core;

/**
 * Class BUTTON
 *
 * Represents the <button> tag.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/button
 */
class BUTTON extends TAG
{
    /**
     * Create a new BUTTON tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $name Name submitted with the form.
     * @param string|null $html Button label (text or HTML).
     * @param string|null $value Value submitted with the form.
     * @param string|null $type "button", "submit" or "reset".
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, ?string $value = null, ?string $type = 'button', ...$args)
    {
        $this->setTagType('button');

        $this->setParameter('type', $type);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('html', $html);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }

    /**
     * Mark (or unmark) the button as required.
     */
    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }

    /**
     * Disable (or enable) the button.
     */
    public function disabled(bool $disabled = true): self
    {
        $this->setParameter('disabled', $disabled);

        return $this;
    }
}
