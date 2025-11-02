<?php

namespace PHTML\Core;

/**
 * Class PARAM
 */
class PARAM extends TAG
{
    public function __construct(string $name = '', string $value = '', ...$args)
    {
        $this->setTagType('param');
        $this->setAllowContent(false);

        if (!empty($name)) {
            $this->setParameter('name', $name);
        }

        if (!empty($value)) {
            $this->setParameter('value', $value);
        }

        $this->setParameters($args);
    }
}
