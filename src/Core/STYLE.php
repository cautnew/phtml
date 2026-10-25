<?php

namespace CN\PHTML\Core;

/**
 * Class STYLE
 *
 * Represents the <style> tag, which holds inline CSS rules.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/style
 */
class STYLE extends TAG
{
    /**
     * Create a new STYLE tag.
     *
     * @param string|null $src Optional "src" attribute (kept for backward compatibility).
     * @param mixed $code CSS code.
     * @param mixed ...$args Extra attributes in "name => value" form (e.g. media).
     */
    public function __construct(?string $src = null, mixed $code = null, ...$args)
    {
        $this->setTagType('style');
        $this->setParameter('src', $src);
        $this->setParameter('append', $code);
        $this->setParameters($args);
    }
}
