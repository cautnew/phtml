<?php

namespace CN\PHTML\Core;

/**
 * Class TRACK
 *
 * Represents the <track> HTML tag: Timed text track (subtitles, captions) for AUDIO/VIDEO. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/track
 */
class TRACK extends NONCONTENTTAG
{
    /**
     * Create a new TRACK tag.
     *
     * @param ?string $src Track file URL (WebVTT).
     * @param ?string $kind One of: subtitles, captions, descriptions, chapters, metadata.
     * @param ?string $srclang Language of the track text, e.g. "en".
     * @param ?string $label User-visible title of the track.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $src = null, ?string $kind = null, ?string $srclang = null, ?string $label = null, mixed ...$args)
    {
        $this->setTagType('track');

        $this->setParameter('src', $src);
        $this->setParameter('kind', $kind);
        $this->setParameter('srclang', $srclang);
        $this->setParameter('label', $label);
        $this->setParameters($args);
    }
}
