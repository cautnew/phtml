<?php

namespace CN\PHTML\Core;

/**
 * Class SOURCE
 *
 * Represents the <source> HTML tag: Media resource for AUDIO, VIDEO or PICTURE. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/source
 */
class SOURCE extends NONCONTENTTAG
{
    /**
     * Create a new SOURCE tag.
     *
     * @param ?string $src Resource URL (use "srcset" through $args for PICTURE).
     * @param ?string $type MIME type, e.g. "video/mp4".
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $src = null, ?string $type = null, mixed ...$args)
    {
        $this->setTagType('source');

        $this->setParameter('src', $src);
        $this->setParameter('type', $type);
        $this->setParameters($args);
    }
}
