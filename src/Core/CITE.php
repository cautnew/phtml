<?php

namespace CN\PHTML\Core;

/**
 * Class CITE
 *
 * Represents the <cite> HTML tag: Title of a creative work (book, film, paper...).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/cite
 */
class CITE extends TAG
{
    /**
     * Create a new CITE tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('cite');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
