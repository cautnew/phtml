<?php

namespace PHTML\Core;

/**
 * Class BUTTON
 */
class BUTTON extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, ?string $html = null, ?string $value = null, ?string $type = 'button', ...$args)
    {
        $this->setTagType('button');

        $this->setParameter('type', $type);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('html', $html);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }

    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }
}
