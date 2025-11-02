<?php

namespace PHTML\Core;

/**
 * Class EMBED
 */
class EMBED extends TAG
{
    public function __construct(?string $type = null, ?string $src = null, ?int $width = null, ?int $height = null, ?string $class = null, ?string $id = null, ...$args)
    {
        $this->setTagType('embed');
        $this->setAllowContent(false);

        $this->setParameter('type', $type);
        $this->setParameter('src', $src);
        $this->setParameter('width', $width);
        $this->setParameter('height', $height);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameters($args);
    }
}
