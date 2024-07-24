<?php

namespace PHTML;

/**
 * Class META
 */
class META extends TAG
{
    public function __construct(string $name, string $value, ...$args)
    {
        $this->setTagType('meta');
        $this->setAllowContent(false);

        $arguments = $args ?? [];
        $arguments['name'] = $name;
        $arguments['content'] = $value;
        $this->setParameters($arguments);
    }
}
