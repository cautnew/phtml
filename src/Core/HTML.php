<?php

namespace CN\PHTML\Core;

/**
 * Class HTML
 *
 * Represents the <html> root tag. The "<!DOCTYPE html>" declaration is
 * automatically rendered before it.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/html
 */
class HTML extends TAG
{
    /**
     * Create a new HTML tag.
     *
     * @param mixed ...$args Extra attributes in "name => value" form (e.g. lang: 'en').
     */
    public function __construct(...$args)
    {
        $this->setTagType('html');
        $this->setParameters($args);
        $this->appendBefore("<!DOCTYPE html>\n");
    }

    /**
     * Set the document language.
     *
     * @param string $lang BCP 47 language tag, e.g. "en" or "pt-BR".
     */
    public function setLang(string $lang): self
    {
        return $this->setParameter('lang', $lang);
    }
}
