<?php

namespace PHTML;

/**
 * Class LINK
 */
class LINK extends TAG
{
    public function __construct(?string $href = null, ?string $rel = null, ?string $type = null, ...$args)
    {
        $this->setTagType('link');
        $this->setAllowContent(false);

        $arguments = $args ?? [];

        if (!empty($href)) {
            $arguments['href'] = $href;
        }

        if (!empty($rel)) {
            $arguments['rel'] = $rel;
        }

        if (!empty($type)) {
            $arguments['type'] = $type;
        }

        $this->setParameters($arguments);
    }
}
