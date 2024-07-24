<?php

namespace PHTML;

/**
 * Class STYLE
 */
class STYLE extends TAG
{
    public function __construct(?string $src = null, mixed $code = null, ...$args)
    {
        $this->setTagType('style');

        $arguments = $args ?? [];

        if (!empty($src)) {
            $arguments['src'] = $src;
        }

        if (!empty($code)) {
            $arguments['append'] = $code;
        }

        $this->setParameters($arguments);
    }
}
