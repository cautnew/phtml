<?php

namespace CN\PHTML\Core;

/**
 * Class EMBED
 *
 * Represents the <embed> HTML tag: Embeds external content such as a plugin. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/embed
 */
class EMBED extends NONCONTENTTAG
{
    /**
     * Create a new EMBED tag.
     *
     * @param ?string $type MIME type of the content.
     * @param ?string $src Content URL.
     * @param ?int $width Width in CSS pixels.
     * @param ?int $height Height in CSS pixels.
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $type = null, ?string $src = null, ?int $width = null, ?int $height = null, ?string $class = null, ?string $id = null, mixed ...$args)
    {
        $this->setTagType('embed');

        $this->setParameter('type', $type);
        $this->setParameter('src', $src);
        $this->setParameter('width', $width);
        $this->setParameter('height', $height);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameters($args);
    }
}
