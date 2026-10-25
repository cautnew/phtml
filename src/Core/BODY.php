<?php

namespace CN\PHTML\Core;

/**
 * Class BODY
 *
 * Represents the <body> tag, which holds the visible content of the page.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/body
 */
class BODY extends TAG
{
    /**
     * Create a new BODY tag.
     *
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(...$args)
    {
        $this->setTagType('body');
        $this->setParameters($args);
    }
}
