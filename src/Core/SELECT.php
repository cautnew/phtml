<?php

namespace CN\PHTML\Core;

/**
 * Class SELECT
 *
 * Represents the <select> HTML tag: Drop-down list. Append OPTION or OPTGROUP tags.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/select
 */
class SELECT extends TAG
{
    /**
     * Create a new SELECT tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $name Name submitted with the form.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('select');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
