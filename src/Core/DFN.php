<?php

namespace CN\PHTML\Core;

/**
 * Class DFN
 *
 * Represents the <dfn> HTML tag: Term being defined.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/dfn
 */
class DFN extends TAG
{
    /**
     * Create a new DFN tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('dfn');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
