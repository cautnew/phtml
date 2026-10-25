<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\TD;
use CN\PHTML\Core\TH;
use CN\PHTML\Core\TR;

/**
 * Class TR_LIST
 *
 * A TR that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: TH, TD.
 */
class TR_LIST extends TR
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        TH::class,
        TD::class,
    ];

    /**
     * Create a new TR_LIST tag.
     *
     * @param iterable $items Children (TH, TD), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of TR (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
