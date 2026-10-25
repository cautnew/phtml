<?php

namespace CN\PHTML\Core;

/**
 * Class IMG
 *
 * Represents the <img> HTML tag: Embeds an image. Void element: cannot hold content.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/img
 */
class IMG extends NONCONTENTTAG
{
    /**
     * Create a new IMG tag.
     *
     * @param ?string $src Image URL.
     * @param ?string $alt Alternative text (important for accessibility).
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $src = null, ?string $alt = null, ?string $class = null, ?string $id = null, mixed ...$args)
    {
        $this->setTagType('img');

        $this->setParameter('src', $src);
        $this->setParameter('alt', $alt);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameters($args);
    }
}
