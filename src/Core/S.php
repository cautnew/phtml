<?php

namespace CN\PHTML\Core;

/**
 * Class S
 *
 * Represents the <s> HTML tag: Text that is no longer accurate or relevant (strikethrough).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/s
 */
class S extends TAG
{
    /**
     * Create a new S tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('s');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
