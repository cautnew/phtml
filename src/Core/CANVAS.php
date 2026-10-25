<?php

namespace CN\PHTML\Core;

/**
 * Class CANVAS
 *
 * Represents the <canvas> HTML tag: Container for graphics drawn with scripts (2D/WebGL).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/canvas
 */
class CANVAS extends TAG
{
    /**
     * Create a new CANVAS tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('canvas');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
