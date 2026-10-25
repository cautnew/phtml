<?php

namespace CN\PHTML\Core;

/**
 * Class H2
 *
 * Represents the <h2> HTML tag: Heading level 2 (1 is the most important, 6 the least).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/h2
 */
class H2 extends TAG
{
    /**
     * Create a new H2 tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('h2');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
