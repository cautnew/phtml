<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\AUDIO;
use CN\PHTML\Core\SOURCE;
use CN\PHTML\Core\TRACK;

/**
 * Class AUDIO_LIST
 *
 * A AUDIO that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: SOURCE, TRACK.
 */
class AUDIO_LIST extends AUDIO
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        SOURCE::class,
        TRACK::class,
    ];

    /**
     * Create a new AUDIO_LIST tag.
     *
     * @param iterable $items Children (SOURCE, TRACK), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of AUDIO (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
