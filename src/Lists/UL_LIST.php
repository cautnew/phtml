<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\LI;
use CN\PHTML\Core\UL;

/**
 * Class UL_LIST
 *
 * A UL that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: LI.
 */
class UL_LIST extends UL
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        LI::class,
    ];

    /**
     * Create a new UL_LIST tag.
     *
     * @param iterable $items Children (LI), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of UL (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
