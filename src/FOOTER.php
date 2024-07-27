<?php

namespace PHTML;

/**
 * Class FOOTER
 */
class FOOTER extends TAG
{
    public function __construct(?string $class = null, ?string $id = null, mixed $html = null, ...$args)
    {
        $this->setTagType('footer');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
