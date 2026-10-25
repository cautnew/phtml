<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\DD;
use CN\PHTML\Core\DL;
use CN\PHTML\Core\DT;

/**
 * Class DL_LIST
 *
 * A DL that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: DT, DD.
 */
class DL_LIST extends DL
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        DT::class,
        DD::class,
    ];

    /**
     * Create a new DL_LIST tag.
     *
     * @param iterable $items Children (DT, DD), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of DL (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
