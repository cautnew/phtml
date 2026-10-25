<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\RP;
use CN\PHTML\Core\RT;
use CN\PHTML\Core\RUBY;

/**
 * Class RUBY_LIST
 *
 * A RUBY that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: RT, RP.
 */
class RUBY_LIST extends RUBY
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        RT::class,
        RP::class,
    ];

    /**
     * Create a new RUBY_LIST tag.
     *
     * @param iterable $items Children (RT, RP), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of RUBY (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
