<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\BODY;
use CN\PHTML\Core\HEAD;
use CN\PHTML\Core\HTML;

/**
 * Class HTML_LIST
 *
 * A HTML that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: HEAD, BODY.
 */
class HTML_LIST extends HTML
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        HEAD::class,
        BODY::class,
    ];

    /**
     * Create a new HTML_LIST tag.
     *
     * @param iterable $items Children (HEAD, BODY), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of HTML (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
