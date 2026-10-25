<?php

namespace CN\PHTML\Core;

/**
 * Class RT
 *
 * Represents the <rt> HTML tag: Ruby text (pronunciation) of a RUBY annotation.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/rt
 */
class RT extends TAG
{
    /**
     * Create a new RT tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('rt');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
