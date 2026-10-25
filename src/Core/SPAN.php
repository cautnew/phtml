<?php

namespace CN\PHTML\Core;

/**
 * Class SPAN
 *
 * Represents the <span> HTML tag: Generic inline container with no semantic meaning.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/span
 */
class SPAN extends TAG
{
    /**
     * Create a new SPAN tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('span');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
