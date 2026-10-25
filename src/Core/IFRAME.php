<?php

namespace CN\PHTML\Core;

/**
 * Class IFRAME
 *
 * Represents the <iframe> HTML tag: Nested browsing context (embeds another page).
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/iframe
 */
class IFRAME extends TAG
{
    /**
     * Create a new IFRAME tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('iframe');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }

    /**
     * Set the URL of the embedded page.
     *
     * @param string $src Page URL.
     */
    public function src(string $src): self
    {
        return $this->setParameter('src', $src);
    }
}
