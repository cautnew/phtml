<?php

namespace CN\PHTML\Core;

/**
 * Class TR
 *
 * Represents the <tr> HTML tag: Row of cells (TH/TD) inside a TABLE, THEAD, TBODY or TFOOT.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/tr
 */
class TR extends TAG
{
    /**
     * Create a new TR tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('tr');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
