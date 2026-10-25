<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\TFOOT;
use CN\PHTML\Core\TR;

/**
 * Class TFOOT_LIST
 *
 * A TFOOT that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: TR.
 */
class TFOOT_LIST extends TFOOT
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        TR::class,
    ];

    /**
     * Create a new TFOOT_LIST tag.
     *
     * @param iterable $items Children (TR), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of TFOOT (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
