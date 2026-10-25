<?php

namespace CN\PHTML\Core;

/**
 * Class COL
 *
 * Represents the <col> HTML tag: Column of a COLGROUP. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/col
 */
class COL extends NONCONTENTTAG
{
    /**
     * Create a new COL tag.
     *
     * @param ?int $span Number of columns the element spans.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?int $span = null, ?string $class = null, mixed ...$args)
    {
        $this->setTagType('col');

        $this->setParameter('span', $span);
        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
