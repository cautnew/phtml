<?php

namespace CN\PHTML\Core;

/**
 * Class TH
 *
 * Represents the <th> HTML tag: Header cell of a TR.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/th
 */
class TH extends TAG
{
    /**
     * Create a new TH tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('th');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
