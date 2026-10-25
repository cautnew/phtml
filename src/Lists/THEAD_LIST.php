<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\THEAD;
use CN\PHTML\Core\TR;

/**
 * Class THEAD_LIST
 *
 * A THEAD that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: TR.
 */
class THEAD_LIST extends THEAD
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        TR::class,
    ];

    /**
     * Create a new THEAD_LIST tag.
     *
     * @param iterable $items Children (TR), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of THEAD (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
