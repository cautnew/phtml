<?php

namespace CN\PHTML\Core;

/**
 * Class SAMP
 *
 * Represents the <samp> HTML tag: Sample output from a program.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/samp
 */
class SAMP extends TAG
{
    /**
     * Create a new SAMP tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('samp');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
