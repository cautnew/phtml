<?php

namespace CN\PHTML\Core;

/**
 * Class TEXTAREA
 *
 * Represents the <textarea> HTML tag: Multi-line text input.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/textarea
 */
class TEXTAREA extends TAG
{
    /**
     * Create a new TEXTAREA tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $name Name submitted with the form.
     * @param mixed $placeholder Hint displayed while the field is empty.
     * @param ?string $html Initial text of the field.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $placeholder = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('textarea');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('placeholder', $placeholder);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
