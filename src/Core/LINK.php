<?php

namespace CN\PHTML\Core;

/**
 * Class LINK
 *
 * Represents the <link> HTML tag: Relationship between the document and an external resource. Belongs in HEAD. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link
 */
class LINK extends NONCONTENTTAG
{
    /**
     * Create a new LINK tag.
     *
     * @param ?string $href Resource URL.
     * @param ?string $rel Relationship, e.g. "stylesheet".
     * @param ?string $type MIME type, e.g. "text/css".
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $href = null, ?string $rel = null, ?string $type = null, mixed ...$args)
    {
        $this->setTagType('link');

        $this->setParameter('href', $href);
        $this->setParameter('rel', $rel);
        $this->setParameter('type', $type);
        $this->setParameters($args);
    }
}
