<?php

namespace PHTML;

/**
 * Class STYLE
 */
class STYLE extends TAG
{
    public function __construct(?string $src = null, mixed $code = null, ...$args)
    {
        $this->setTagType('style');

        $this->setParameter('src', $src);
        $this->setParameter('append', $code);
        $this->setParameters($args);
    }
}
