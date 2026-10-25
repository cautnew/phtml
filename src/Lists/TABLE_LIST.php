<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\CAPTION;
use CN\PHTML\Core\COLGROUP;
use CN\PHTML\Core\TABLE;
use CN\PHTML\Core\TBODY;
use CN\PHTML\Core\TFOOT;
use CN\PHTML\Core\THEAD;
use CN\PHTML\Core\TR;

/**
 * Class TABLE_LIST
 *
 * A TABLE that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: CAPTION, COLGROUP, THEAD, TBODY, TFOOT, TR.
 */
class TABLE_LIST extends TABLE
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        CAPTION::class,
        COLGROUP::class,
        THEAD::class,
        TBODY::class,
        TFOOT::class,
        TR::class,
    ];

    /**
     * Create a new TABLE_LIST tag.
     *
     * @param iterable $items Children (CAPTION, COLGROUP, THEAD, TBODY, TFOOT, TR), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of TABLE (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
