<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\OPTGROUP;
use CN\PHTML\Core\OPTION;
use CN\PHTML\Core\SELECT;

/**
 * Class SELECT_LIST
 *
 * A SELECT that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: OPTION, OPTGROUP.
 */
class SELECT_LIST extends SELECT
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        OPTION::class,
        OPTGROUP::class,
    ];

    /**
     * Create a new SELECT_LIST tag.
     *
     * @param iterable $items Children (OPTION, OPTGROUP), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of SELECT (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
