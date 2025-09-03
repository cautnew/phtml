<?php

namespace PHTML\Core;

/**
 * Class INPUT_HIDDEN
 */
class INPUT_HIDDEN extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

        $this->setParameter('type', 'hidden');
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }
}
