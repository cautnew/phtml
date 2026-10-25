<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\AREA;
use CN\PHTML\Core\MAP;

/**
 * Class MAP_LIST
 *
 * A MAP that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: AREA.
 */
class MAP_LIST extends MAP
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        AREA::class,
    ];

    /**
     * Create a new MAP_LIST tag.
     *
     * @param iterable $items Children (AREA), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of MAP (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
