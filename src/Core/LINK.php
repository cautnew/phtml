<?php

namespace PHTML\Core;

/**
 * Class LINK
 */
class LINK extends TAG
{
    public function __construct(?string $href = null, ?string $rel = null, ?string $type = null, ...$args)
    {
        $this->setTagType('link');
        $this->setAllowContent(false);

        $this->setParameter('href', $href);
        $this->setParameter('rel', $rel);
        $this->setParameter('type', $type);
        $this->setParameters($args);
    }
}
