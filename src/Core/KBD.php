<?php

namespace CN\PHTML\Core;

/**
 * Class KBD
 *
 * Represents the <kbd> HTML tag: Keyboard input.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/kbd
 */
class KBD extends TAG
{
    /**
     * Create a new KBD tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('kbd');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
