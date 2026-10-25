<?php

namespace CN\PHTML\Core;

/**
 * Class CAPTION
 *
 * Represents the <caption> tag, the title of a TABLE. It must be the first
 * child of the table.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/caption
 */
class CAPTION extends TAG
{
    /**
     * Create a new CAPTION tag.
     *
     * @param string|null $class CSS class(es), separated by spaces.
     * @param string|null $id Value of the "id" attribute.
     * @param string|null $side CSS "caption-side": top or bottom.
     * @param string|null $align CSS "text-align": left, center or right.
     * @param string|null $html Caption text (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form.
     */
    public function __construct(?string $class = null, ?string $id = null, ?string $side = null, ?string $align = null, ?string $html = null, ...$args)
    {
        $this->setTagType('caption');

        $this->setParameter('class', $class);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);

        if ($side !== null) {
            $this->side($side);
        }

        if ($align !== null) {
            $this->setStyleParameter('text-align', $align);
        }
    }

    /**
     * Set the caption position.
     *
     * @param string $side "top" or "bottom".
     */
    public function side(string $side): self
    {
        return $this->setStyleParameter('caption-side', $side);
    }
}
