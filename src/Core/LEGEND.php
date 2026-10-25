<?php

namespace CN\PHTML\Core;

/**
 * Class LEGEND
 *
 * Represents the <legend> HTML tag: Caption of a FIELDSET.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/legend
 */
class LEGEND extends TAG
{
    /**
     * Create a new LEGEND tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('legend');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
