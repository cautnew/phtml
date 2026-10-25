<?php

namespace CN\PHTML\Core;

/**
 * Class WBR
 *
 * Represents the <wbr> HTML tag: Word break opportunity: where the browser may break a long word.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/wbr
 */
class WBR extends NONCONTENTTAG
{
    /**
     * Create a new WBR tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, mixed ...$args)
    {
        $this->setTagType('wbr');

        $this->setParameter('class', $class);
        $this->setParameters($args);
    }
}
