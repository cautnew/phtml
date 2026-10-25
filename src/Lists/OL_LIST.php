<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\LI;
use CN\PHTML\Core\OL;

/**
 * Class OL_LIST
 *
 * A OL that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: LI.
 */
class OL_LIST extends OL
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        LI::class,
    ];

    /**
     * Create a new OL_LIST tag.
     *
     * @param iterable $items Children (LI), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of OL (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
