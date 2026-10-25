<?php

namespace CN\PHTML\Core;

/**
 * Class Q
 *
 * Represents the <q> HTML tag: Short inline quotation.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/q
 */
class Q extends TAG
{
    /**
     * Create a new Q tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('q');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
