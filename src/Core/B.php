<?php

namespace CN\PHTML\Core;

/**
 * Class B
 *
 * Represents the <b> HTML tag: Draws attention to text without conveying extra importance (bold by default).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/b
 */
class B extends TAG
{
    /**
     * Create a new B tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('b');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
