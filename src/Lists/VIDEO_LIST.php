<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\SOURCE;
use CN\PHTML\Core\TRACK;
use CN\PHTML\Core\VIDEO;

/**
 * Class VIDEO_LIST
 *
 * A VIDEO that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: SOURCE, TRACK.
 */
class VIDEO_LIST extends VIDEO
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        SOURCE::class,
        TRACK::class,
    ];

    /**
     * Create a new VIDEO_LIST tag.
     *
     * @param iterable $items Children (SOURCE, TRACK), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of VIDEO (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
