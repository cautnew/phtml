<?php

namespace CN\PHTML\Core;

/**
 * Class ABBR
 *
 * Represents the <abbr> HTML tag: Abbreviation or acronym. Use the "title" attribute for the expansion.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/abbr
 */
class ABBR extends TAG
{
    /**
     * Create a new ABBR tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('abbr');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
