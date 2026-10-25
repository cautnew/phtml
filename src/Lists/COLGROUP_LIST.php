<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\COL;
use CN\PHTML\Core\COLGROUP;

/**
 * Class COLGROUP_LIST
 *
 * A COLGROUP that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: COL.
 */
class COLGROUP_LIST extends COLGROUP
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        COL::class,
    ];

    /**
     * Create a new COLGROUP_LIST tag.
     *
     * @param iterable $items Children (COL), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of COLGROUP (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
