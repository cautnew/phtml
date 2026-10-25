<?php

namespace CN\PHTML\Core;

/**
 * Class MARK
 *
 * Represents the <mark> HTML tag: Text highlighted for reference or relevance.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/mark
 */
class MARK extends TAG
{
    /**
     * Create a new MARK tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('mark');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
