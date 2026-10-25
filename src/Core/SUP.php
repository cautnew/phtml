<?php

namespace CN\PHTML\Core;

/**
 * Class SUP
 *
 * Represents the <sup> HTML tag: Superscript text.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/sup
 */
class SUP extends TAG
{
    /**
     * Create a new SUP tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('sup');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
