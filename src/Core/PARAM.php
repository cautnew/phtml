<?php

namespace CN\PHTML\Core;

/**
 * Class PARAM
 *
 * Represents the <param> HTML tag: Parameter for an OBJECT element. Void element.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/param
 */
class PARAM extends NONCONTENTTAG
{
    /**
     * Create a new PARAM tag.
     *
     * @param string $name Parameter name.
     * @param string $value Parameter value.
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(string $name = '', string $value = '', mixed ...$args)
    {
        $this->setTagType('param');

        $this->setParameter('name', $name);
        $this->setParameter('value', $value);
        $this->setParameters($args);
    }
}
