<?php

namespace CN\PHTML\Core;

/**
 * Class TIME
 *
 * Represents the <time> HTML tag: Specific period or date/time. Use the "datetime" attribute for a machine-readable value.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/time
 */
class TIME extends TAG
{
    /**
     * Create a new TIME tag.
     *
     * @param ?string $datetime Machine-readable value, e.g. "2024-05-01".
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $datetime = null, ?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('time');

        $this->setParameter('datetime', $datetime);
        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
