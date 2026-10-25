<?php

namespace CN\PHTML\Core;

/**
 * Class A
 *
 * Represents the <a> HTML tag: Hyperlink to another page, file, anchor or URL.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/a
 */
class A extends TAG
{
    /**
     * Create a new A tag.
     *
     * @param ?string $href Link destination.
     * @param ?string $html Initial inner content (text or HTML).
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $id Value of the "id" attribute.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $href = null, ?string $html = null, ?string $class = null, ?string $id = null, mixed ...$args)
    {
        $this->setTagType('a');

        $this->setParameter('href', $href);
        $this->setParameter('html', $html);
        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameters($args);
    }

    /**
     * Set where the link opens, e.g. "_blank" for a new tab.
     * When opening a new tab, "noopener" is added to the "rel" attribute.
     *
     * @param string $target Browsing context name.
     */
    public function target(string $target): self
    {
        $this->setParameter('target', $target);

        if ($target === '_blank') {
            $this->setParameter('rel', 'noopener noreferrer');
        }

        return $this;
    }
}
