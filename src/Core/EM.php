<?php

namespace CN\PHTML\Core;

/**
 * Class EM
 *
 * Represents the <em> HTML tag: Stress emphasis (italic by default).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/em
 */
class EM extends TAG
{
    /**
     * Create a new EM tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('em');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
