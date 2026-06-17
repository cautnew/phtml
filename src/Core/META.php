<?php

namespace PHTML\Core;

/**
 * Class META
 */
class META extends NONCONTENTTAG
{
    public function __construct(string $name = '', string $value = '', ...$args)
    {
        $this->setTagType('meta');

        if (!empty($name)) {
            $this->setParameter('name', $name);
        }

        if (!empty($value)) {
            $this->setParameter('value', $value);
        }

        $this->setParameters($args);
    }
}
