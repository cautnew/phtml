<?php

namespace CN\PHTML\Core;

/**
 * Class BASE
 *
 * Represents the <base> HTML tag: Base URL and default target for relative links. Belongs in HEAD. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/base
 */
class BASE extends NONCONTENTTAG
{
    /**
     * Create a new BASE tag.
     *
     * @param ?string $href Base URL.
     * @param ?string $target Default browsing context, e.g. "_blank".
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $href = null, ?string $target = null, mixed ...$args)
    {
        $this->setTagType('base');

        $this->setParameter('href', $href);
        $this->setParameter('target', $target);
        $this->setParameters($args);
    }
}
