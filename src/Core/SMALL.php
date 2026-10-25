<?php

namespace CN\PHTML\Core;

/**
 * Class SMALL
 *
 * Represents the <small> HTML tag: Side comments and small print, such as copyright notices.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/small
 */
class SMALL extends TAG
{
    /**
     * Create a new SMALL tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('small');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
