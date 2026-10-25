<?php

namespace CN\PHTML\Core;

/**
 * Class DEL
 *
 * Represents the <del> HTML tag: Text that was removed from the document.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/del
 */
class DEL extends TAG
{
    /**
     * Create a new DEL tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('del');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
