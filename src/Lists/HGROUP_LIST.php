<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\H1;
use CN\PHTML\Core\H2;
use CN\PHTML\Core\H3;
use CN\PHTML\Core\H4;
use CN\PHTML\Core\H5;
use CN\PHTML\Core\H6;
use CN\PHTML\Core\HGROUP;
use CN\PHTML\Core\P;

/**
 * Class HGROUP_LIST
 *
 * A HGROUP that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: H1, H2, H3, H4, H5, H6, P.
 */
class HGROUP_LIST extends HGROUP
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        H1::class,
        H2::class,
        H3::class,
        H4::class,
        H5::class,
        H6::class,
        P::class,
    ];

    /**
     * Create a new HGROUP_LIST tag.
     *
     * @param iterable $items Children (H1, H2, H3, H4, H5, H6, P), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of HGROUP (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
