<?php

namespace CN\PHTML\Core;

/**
 * Class DATA
 *
 * Represents the <data> HTML tag: Links content to a machine-readable value.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/data
 */
class DATA extends TAG
{
    /**
     * Create a new DATA tag.
     *
     * @param ?string $value Machine-readable value.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $value = null, ?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('data');

        $this->setParameter('value', $value);
        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
