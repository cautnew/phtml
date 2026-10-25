<?php

namespace CN\PHTML\Core;

/**
 * Class OPTION
 *
 * Represents the <option> tag, an item of a SELECT, OPTGROUP or DATALIST.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/option
 */
class OPTION extends TAG
{
    /**
     * Create a new OPTION tag.
     *
     * @param string $value Value submitted when this option is selected.
     * @param string $text Text shown to the user.
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(string $value, string $text, ...$args)
    {
        $this->setTagType('option');

        $this->setParameter('value', $value);
        $this->setParameters($args);
        $this->append($text);
    }

    /**
     * Mark (or unmark) the option as required.
     */
    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }

    /**
     * Mark (or unmark) the option as pre-selected.
     */
    public function selected(bool $selected = true): self
    {
        $this->setParameter('selected', $selected);

        return $this;
    }

    /**
     * Disable (or enable) the option.
     */
    public function disabled(bool $disabled = true): self
    {
        $this->setParameter('disabled', $disabled);

        return $this;
    }
}
