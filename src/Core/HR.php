<?php

namespace CN\PHTML\Core;

/**
 * Class HR
 *
 * Represents the <hr> HTML tag: Thematic break between paragraph-level elements (horizontal rule).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/hr
 */
class HR extends NONCONTENTTAG
{
    /**
     * Create a new HR tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, mixed ...$args)
    {
        $this->setTagType('hr');

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
