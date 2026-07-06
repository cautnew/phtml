<?php

namespace CN\PHTML\Core;

use CN\PHTML\ArrayTAG;

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

    public function append(TAG | ArrayTAG | string | null $content, bool $clear = true): self
    {
        return parent::append($content, true);
    }

    public function setTitle(?string $title): self
    {
        return self::append($title, true);
    }
}
