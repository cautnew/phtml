<?php

namespace CN\PHTML\Core;

/**
 * Class H5
 *
 * Represents the <h5> HTML tag: Heading level 5 (1 is the most important, 6 the least).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/h5
 */
class H5 extends TAG
{
    /**
     * Create a new H5 tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('h5');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
