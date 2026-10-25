<?php

namespace CN\PHTML\Core;

use CN\PHTML\ArrayTAG;

/**
 * Class TITLE
 *
 * Represents the <title> tag. It holds a single text and accepts no
 * attributes: appending new content always replaces the previous one.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/title
 */
class TITLE extends TAG
{
    /**
     * Create a new TITLE tag.
     *
     * @param string $title Document title.
     */
    public function __construct(string $title = '')
    {
        $this->setTagType('title');
        $this->append($title);
        $this->setAllowParameter(false);
    }

    /**
     * Replace the title text.
     *
     * @param TAG|ArrayTAG|string|null $content New title.
     * @param bool $clear Ignored: the previous content is always replaced.
     */
    public function append(TAG | ArrayTAG | string | null $content, bool $clear = true): self
    {
        return parent::append($content, true);
    }

    /**
     * Replace the title text.
     *
     * @param string|null $title New title.
     */
    public function setTitle(?string $title): self
    {
        return self::append($title, true);
    }
}
