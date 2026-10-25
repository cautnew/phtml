<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\PARAM;
use CN\PHTML\Core\TAG_OBJECT;

/**
 * Class TAG_OBJECT_LIST
 *
 * A TAG_OBJECT that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: PARAM.
 */
class TAG_OBJECT_LIST extends TAG_OBJECT
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        PARAM::class,
    ];

    /**
     * Create a new TAG_OBJECT_LIST tag.
     *
     * @param iterable $items Children (PARAM), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of TAG_OBJECT (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
