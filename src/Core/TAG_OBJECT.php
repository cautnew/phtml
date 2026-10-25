<?php

namespace CN\PHTML\Core;

/**
 * Class TAG_OBJECT
 *
 * Represents the <object> tag (named TAG_OBJECT because OBJECT is a
 * reserved word in PHP). Append PARAM tags for its parameters.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/object
 */
class TAG_OBJECT extends TAG
{
    /**
     * Create a new OBJECT tag.
     *
     * @param mixed ...$args Attributes in "name => value" form (e.g. data, type, width).
     */
    public function __construct(...$args)
    {
        $this->setTagType('object');
        $this->setParameters($args);
    }
}
