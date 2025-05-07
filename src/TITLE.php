<?php

namespace PHTML;

/**
 * Class TITLE
 */
class TITLE extends TAG
{
    public function __construct(string $title = '')
    {
        $this->setTagType('title');
        $this->append($title);
        $this->setAllowParameter(false);
    }

    public function append(TAG | string | array | null $content): self
    {
        return $this->clearAppend($content);
    }
}
