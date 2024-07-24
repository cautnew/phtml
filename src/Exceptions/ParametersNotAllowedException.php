<?php

namespace PHTML\Exceptions;

use \Exception;

class ParametersNotAllowedException extends Exception
{
    public function __construct(string $tagName)
    {
        parent::__construct("You cannot set parameters in tag {$tagName}.", '333000');
    }
}
