<?php

namespace PHTML;

/**
 * Class SCRIPT
 */
class SCRIPT extends TAG
{
    public function __construct(?string $src = null, ?string $type = null, mixed $code = null, ...$args)
    {
        $this->setTagType('script');

        $arguments = $args ?? [];

        if (!empty($src)) {
            $arguments['src'] = $src;
        }

        if (!empty($type)) {
            $arguments['type'] = $type;
        }

        if (!empty($code)) {
            $arguments['append'] = $code;
        }

        $this->setParameters($arguments);
    }
}
