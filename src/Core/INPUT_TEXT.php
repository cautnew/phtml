<?php

namespace PHTML\Core;

/**
 * Class INPUT_TEXT
 */
class INPUT_TEXT extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $placeholder = null, ?string $value = null, ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

        $this->setParameter('type', 'text');
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('placeholder', $placeholder);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }
}
