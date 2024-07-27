<?php

namespace PHTML;

/**
 * Class META
 */
class META extends TAG
{
    public function __construct(string $name, string $value, ...$args)
    {
        $this->setTagType('meta');
        $this->setAllowContent(false);

        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }
}
