<?php

namespace CN\PHTML\Core;

/**
 * Class SLOT
 *
 * Represents the <slot> HTML tag: Placeholder inside a web component (shadow DOM).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/slot
 */
class SLOT extends TAG
{
    /**
     * Create a new SLOT tag.
     *
     * @param ?string $name Slot name.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $name = null, ?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('slot');

        $this->setParameter('name', $name);
        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
