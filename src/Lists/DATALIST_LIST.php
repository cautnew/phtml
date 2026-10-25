<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\DATALIST;
use CN\PHTML\Core\OPTION;

/**
 * Class DATALIST_LIST
 *
 * A DATALIST that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: OPTION.
 */
class DATALIST_LIST extends DATALIST
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        OPTION::class,
    ];

    /**
     * Create a new DATALIST_LIST tag.
     *
     * @param iterable $items Children (OPTION), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of DATALIST (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
