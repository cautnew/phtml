<?php

namespace PHTML;

/**
 * Class SCRIPT
 */
class SCRIPT extends TAG
{
    public function __construct(?string $src = null, ?string $type = null, array | string | null $code = null, ...$args)
    {
        $this->setTagType('script');

        $this->setParameter('src', $src);
        $this->setParameter('type', $type);
        $this->setParameter('append', $code);
        $this->setParameters($args);
    }
}
