<?php

namespace CN\PHTML\Core;

use CN\PHTML\Exceptions\ContentNotAllowedException;
use CN\PHTML\ArrayTAG;

/**
 * Class NONCONTENTTAG
 *
 * Base class of void HTML tags (br, hr, img, input, meta, link...), which
 * cannot hold inner content and are rendered self-closed: <br />.
 */
abstract class NONCONTENTTAG extends TAG
{
    /** Void tags never accept inner content. */
    protected bool $allowContent = false;

    /**
     * You cannot change this parameter. Always false.
     * @param bool $allowContent = false
     * @return NONCONTENTTAG
     */
    public function setAllowContent(bool $allowContent = false): self
    {
        $this->allowContent = false;
        return $this;
    }

    /**
     * You cannot append content to this tag. It will throw an exception if you try.
     * @param TAG|ArrayTAG|string|null $content
     * @param bool $replace
     * If true, the current append list will be replaced by the new content.
     * If false, the new content will be added to the current append list.
     * @throws ContentNotAllowedException
     * @return TAG
     */
    public function append(TAG|ArrayTAG|string|null $content, bool $replace = false): self
    {
        throw new ContentNotAllowedException($this->tagType);
    }
}
