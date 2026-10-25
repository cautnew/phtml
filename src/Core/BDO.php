<?php

namespace CN\PHTML\Core;

/**
 * Class BDO
 *
 * Represents the <bdo> HTML tag: Overrides the text direction. Set the "dir" attribute.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/bdo
 */
class BDO extends TAG
{
    /**
     * Create a new BDO tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('bdo');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
