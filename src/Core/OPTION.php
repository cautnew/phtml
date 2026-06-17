<?php

namespace PHTML\Core;

/**
 * Class OPTION
 */
class OPTION extends TAG
{
    /**
     * Create a new OPTION tag.
     * @param mixed $value
     * @param mixed $text
     * @param array $args
     */
    public function __construct(string $value, string $text, ...$args)
    {
        $this->setTagType('option');

        $this->setParameter('value', $value);
        $this->setParameters($args);
        $this->append($text);
    }

    public function required(bool $required = true): self
    {
        $this->setParameter('required', $required);

        return $this;
    }
}
