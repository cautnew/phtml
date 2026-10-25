<?php

namespace CN\PHTML\Core;

/**
 * Class SCRIPT
 *
 * Represents the <script> tag. Use "src" for an external file or $code for
 * an inline script.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/script
 */
class SCRIPT extends TAG
{
    /**
     * Create a new SCRIPT tag.
     *
     * @param string|null $src External script URL.
     * @param string|null $type MIME type or "module".
     * @param array|string|null $code Inline JavaScript code.
     * @param mixed ...$args Extra attributes (e.g. defer, async through "name => value").
     */
    public function __construct(?string $src = null, ?string $type = null, array | string | null $code = null, ...$args)
    {
        $this->setTagType('script');
        $this->setParameter('src', $src);
        $this->setParameter('type', $type);
        $this->setParameter('append', $code);
        $this->setParameters($args);
    }
}
