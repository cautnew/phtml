<?php

namespace PHTML\Core;

/**
 * Class LINK
 */
class LINK extends NONCONTENTTAG
{
    public function __construct(?string $href = null, ?string $rel = null, ?string $type = null, ...$args)
    {
        $this->setTagType('link');

        $this->setParameter('href', $href);
        $this->setParameter('rel', $rel);
        $this->setParameter('type', $type);
        $this->setParameters($args);
    }
}
