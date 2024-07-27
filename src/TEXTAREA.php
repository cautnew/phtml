<?php

namespace PHTML;

/**
 * Class TEXTAREA
 */
class TEXTAREA extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, ?string $name = null, mixed $placeholder = null, ?string $html = null, ...$args)
    {
        $this->setTagType('textarea');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('name', $name);
        $this->setParameter('placeholder', $placeholder);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
