<?php

namespace PHTML\Core;

/**
 * Class CAPTION
 */
class CAPTION extends TAG
{
    /**
     * Create a new CAPTION tag.
     * @param mixed $class
     * @param mixed $id
     * @param mixed $side
     * @param mixed $align
     * @param mixed $html
     * @param array $args
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $side = null, ?string $align = null, ?string $html = null, ...$args)
    {
        $this->setTagType('caption');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
        $this->setStyleParameter('caption-side', $side);
        $this->setStyleParameter('text-align', $align);
    }

    public function side(string $side): self
    {
        $this->setParameter('style', "caption-side: $side;");

        return $this;
    }
}
