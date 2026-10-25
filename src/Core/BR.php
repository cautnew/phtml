<?php

namespace CN\PHTML\Core;

/**
 * Class BR
 *
 * Represents the <br> HTML tag: Line break. Void element: cannot hold content.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/br
 */
class BR extends NONCONTENTTAG
{
    /**
     * Create a new BR tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, mixed ...$args)
    {
        $this->setTagType('br');

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
