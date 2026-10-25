<?php

namespace CN\PHTML\Core;

/**
 * Class RP
 *
 * Represents the <rp> HTML tag: Fallback parentheses for browsers without RUBY support.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/rp
 */
class RP extends TAG
{
    /**
     * Create a new RP tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('rp');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
