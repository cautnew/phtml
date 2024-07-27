<?php

namespace PHTML;

/**
 * Class FORM
 */
class FORM extends TAG
{
    public function __construct(?string $class = null, ?string $action = null, ?string $method = null, ?string $id = null, ?string $html = null, ...$args)
    {
        $this->setTagType('form');

        $this->setParameter('class', $class);
        $this->setParameter('action', $action);
        $this->setParameter('method', $method);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
