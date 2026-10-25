<?php

namespace CN\PHTML\Lists;

use CN\PHTML\Core\BASE;
use CN\PHTML\Core\HEAD;
use CN\PHTML\Core\LINK;
use CN\PHTML\Core\META;
use CN\PHTML\Core\NOSCRIPT;
use CN\PHTML\Core\SCRIPT;
use CN\PHTML\Core\STYLE;
use CN\PHTML\Core\TEMPLATE;
use CN\PHTML\Core\TITLE;

/**
 * Class HEAD_LIST
 *
 * A HEAD that receives its children as a list. Only these child tags are
 * accepted, following the HTML content model: TITLE, META, LINK, BASE, SCRIPT, STYLE, NOSCRIPT, TEMPLATE.
 */
class HEAD_LIST extends HEAD
{
    use HasChildrenList;

    /** Tag classes accepted as children. */
    public const CHILDREN = [
        TITLE::class,
        META::class,
        LINK::class,
        BASE::class,
        SCRIPT::class,
        STYLE::class,
        NOSCRIPT::class,
        TEMPLATE::class,
    ];

    /**
     * Create a new HEAD_LIST tag.
     *
     * @param iterable $items Children (TITLE, META, LINK, BASE, SCRIPT, STYLE, NOSCRIPT, TEMPLATE), as an array or ArrayTAG.
     * @param mixed ...$args Same arguments of HEAD (class, id, html, extra attributes...).
     * @throws \InvalidArgumentException If an item is not an allowed child.
     */
    public function __construct(iterable $items = [], mixed ...$args)
    {
        parent::__construct(...$args);
        $this->setItems($items);
    }
}
