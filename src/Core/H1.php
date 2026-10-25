<?php

namespace CN\PHTML\Core;

/**
 * Class H1
 *
 * Represents the <h1> HTML tag: Heading level 1 (1 is the most important, 6 the least).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/h1
 */
class H1 extends TAG
{
    /**
     * Create a new H1 tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('h1');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
