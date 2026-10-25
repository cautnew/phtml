<?php

namespace CN\PHTML\Core;

/**
 * Class AREA
 *
 * Represents the <area> HTML tag: Clickable area inside a MAP. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/area
 */
class AREA extends NONCONTENTTAG
{
    /**
     * Create a new AREA tag.
     *
     * @param ?string $href Link destination.
     * @param ?string $alt Alternative text.
     * @param ?string $shape One of: rect, circle, poly, default.
     * @param ?string $coords Comma separated coordinates matching the shape.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $href = null, ?string $alt = null, ?string $shape = null, ?string $coords = null, mixed ...$args)
    {
        $this->setTagType('area');

        $this->setParameter('href', $href);
        $this->setParameter('alt', $alt);
        $this->setParameter('shape', $shape);
        $this->setParameter('coords', $coords);
        $this->setParameters($args);
    }
}
