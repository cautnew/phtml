<?php

namespace CN\PHTML\Core;

/**
 * Class LABEL
 *
 * Represents the <label> HTML tag: Caption for a form control.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/label
 */
class LABEL extends TAG
{
    /**
     * Create a new LABEL tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $for The "id" of the control this label belongs to.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $for = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('label');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('for', $for);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
