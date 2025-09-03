<?php

namespace PHTML\Core;

/**
 * Class INPUT
 */
class INPUT extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $value = null, ?string $type = 'text', ...$args)
    {
        $this->setTagType('input');
        $this->setAllowContent(false);

        $this->setParameter('type', $type);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }

    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }
}
