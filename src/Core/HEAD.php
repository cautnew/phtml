<?php

namespace CN\PHTML\Core;

/**
 * Class HEAD
 *
 * Represents the <head> tag, which holds document metadata (TITLE, META,
 * LINK, SCRIPT, STYLE, BASE). Attributes are not allowed on it.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/head
 */
class HEAD extends TAG
{
    /**
     * Create a new HEAD tag.
     *
     * @param mixed ...$args Accepted for API consistency; attributes are disallowed on this tag.
     */
    public function __construct(...$args)
    {
        $this->setTagType('head');
        $this->setAllowParameter(false);
        $this->setParameters($args);
    }
}
