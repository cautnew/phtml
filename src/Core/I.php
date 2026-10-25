<?php

namespace CN\PHTML\Core;

/**
 * Class I
 *
 * Represents the <i> HTML tag: Text in an alternate voice or mood (italic by default). Content is allowed, so it also works for icon fonts: <i class="icon"></i>.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/i
 */
class I extends TAG
{
    /**
     * Create a new I tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('i');

        $this->setParameter('class', $class);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
