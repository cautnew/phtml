<?php

namespace PHTML\Exceptions;

use \Exception;

class ContentNotAllowedException extends Exception
{
    public function __construct(string $tagName)
    {
        parent::__construct("You cannot add content in tag {$tagName}.", '444000');
    }
}
