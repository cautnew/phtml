<?php

namespace CN\PHTML\Core;

/**
 * Class OPTGROUP
 *
 * Represents the <optgroup> HTML tag: Group of OPTION tags inside a SELECT.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/optgroup
 */
class OPTGROUP extends TAG
{
    /**
     * Create a new OPTGROUP tag.
     *
     * @param ?string $label Name of the group.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $label = null, ?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('optgroup');

        $this->setParameter('label', $label);
        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }

    /**
     * Disable (or enable) every option of the group.
     */
    public function disabled(bool $disabled = true): self
    {
        return $this->setParameter('disabled', $disabled);
    }
}
