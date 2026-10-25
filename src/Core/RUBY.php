<?php

namespace CN\PHTML\Core;

/**
 * Class RUBY
 *
 * Represents the <ruby> HTML tag: Ruby annotation (East Asian typography). Uses RT and RP children.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/ruby
 */
class RUBY extends TAG
{
    /**
     * Create a new RUBY tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('ruby');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
