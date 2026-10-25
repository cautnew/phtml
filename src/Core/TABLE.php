<?php

namespace CN\PHTML\Core;

/**
 * Class TABLE
 *
 * Represents the <table> HTML tag: Tabular data. Children: CAPTION, COLGROUP, THEAD, TBODY, TFOOT and TR.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/table
 */
class TABLE extends TAG
{
    /**
     * Create a new TABLE tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('table');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
