<?php

namespace CN\PHTML\Core;

/**
 * Class META
 *
 * Represents the <meta> HTML tag: Document metadata. Belongs in HEAD. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta
 */
class META extends NONCONTENTTAG
{
    /**
     * Create a new META tag.
     *
     * @param string $name Metadata name, e.g. "viewport" (or use "charset" through $args).
     * @param string $content Metadata value (rendered as the "content" attribute).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(string $name = '', string $content = '', mixed ...$args)
    {
        $this->setTagType('meta');

        $this->setParameter('name', $name);
        $this->setParameter('content', $content);
        $this->setParameters($args);
    }
}
