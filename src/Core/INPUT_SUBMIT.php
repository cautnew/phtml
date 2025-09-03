<?php

namespace PHTML\Core;

/**
 * Class INPUT_SUBMIT
 */
class INPUT_SUBMIT extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $value = null, ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

        $this->setParameter('type', 'submit');
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }
}
