<?php

namespace CN\PHTML\Core;

/**
 * Class FORM
 *
 * Represents the <form> HTML tag: Interactive form that submits data to a server.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/form
 */
class FORM extends TAG
{
    /**
     * Create a new FORM tag.
     *
     * @param ?string $class CSS class(es), separated by spaces.
     * @param ?string $action URL that processes the submission.
     * @param ?string $method HTTP method: "get" or "post".
     * @param ?string $id Value of the "id" attribute.
     * @param ?string $html Initial inner content (text or HTML).
     * @param mixed ...$args Extra attributes in "name => value" form (also accepts "data", "aria" and "append").
     */
    public function __construct(?string $class = null, ?string $action = null, ?string $method = null, ?string $id = null, ?string $html = null, mixed ...$args)
    {
        $this->setTagType('form');

        $this->setParameter('class', $class);
        $this->setParameter('action', $action);
        $this->setParameter('method', $method);
        $this->setParameter('id', $id);
        $this->setParameter('html', $html);
        $this->setParameters($args);
    }
}
