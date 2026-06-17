<?php

namespace PHTML\Core;

class NONCONTENTTAG extends TAG
{
    protected bool $allowContent = false;

    /**
     * You cannot change this parameter. Always false.
     * @param bool $allowContent = false
     * @return NONCONTENTTAG
     */
    public function setAllowContent(bool $allowContent = false): self
    {
        $this->allowContent = false;
        return $this;
    }
}
