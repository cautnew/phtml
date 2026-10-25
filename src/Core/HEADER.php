<?php

namespace CN\PHTML\Core;

/**
 * Class HEADER
 *
 * Represents the <header> HTML tag: Introductory content, typically a group of navigational aids or headings.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/header
 */
class HEADER extends TAG
{
    /**
     * Create a new HEADER tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('header');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
