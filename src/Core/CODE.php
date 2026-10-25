<?php

namespace CN\PHTML\Core;

/**
 * Class CODE
 *
 * Represents the <code> HTML tag: Fragment of computer code.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/code
 */
class CODE extends TAG
{
    /**
     * Create a new CODE tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('code');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
