<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\IMG;
use CN\PHTML\Core\PICTURE;
use CN\PHTML\Core\SOURCE;

/**
 * Class PICTURE_LIST
 *
 * A PICTURE that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: SOURCE, IMG.
 */
class PICTURE_LIST extends PICTURE
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        SOURCE::class,
        IMG::class,
    ];

    /**
     * Create a new PICTURE_LIST tag.
     *
     * @param iterable $items Children (SOURCE, IMG), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of PICTURE (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
