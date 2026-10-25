<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\OPTGROUP;
use CN\PHTML\Core\OPTION;

/**
 * Class OPTGROUP_LIST
 *
 * A OPTGROUP that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: OPTION.
 */
class OPTGROUP_LIST extends OPTGROUP
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        OPTION::class,
    ];

    /**
     * Create a new OPTGROUP_LIST tag.
     *
     * @param iterable $items Children (OPTION), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of OPTGROUP (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
