<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\TBODY;
use CN\PHTML\Core\TR;

/**
 * Class TBODY_LIST
 *
 * A TBODY that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: TR.
 */
class TBODY_LIST extends TBODY
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        TR::class,
    ];

    /**
     * Create a new TBODY_LIST tag.
     *
     * @param iterable $items Children (TR), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of TBODY (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
