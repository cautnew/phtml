<?php

namespace CN\PHTML\Core;

/**
 * Class VARIABLE
 *
 * Represents the <var> HTML tag: Variable name in math or programming.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/var
 */
class VARIABLE extends TAG
{
    /**
     * Create a new VARIABLE tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('var');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
