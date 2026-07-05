<?php

namespace CN\PHTML\Core;

/**
 * Class PARAM
 */
class PARAM extends NONCONTENTTAG
{
    public function __construct(string $name = '', string $value = '', ...$args)
    {
        $this->setTagType('param');

        if (!empty($name)) {
            $this->setParameter('name', $name);
        }

        if (!empty($value)) {
            $this->setParameter('value', $value);
        }

        $this->setParameters($args);
    }
}
