<?php

namespace CN\PHTML;

use CN\PHTML\Core\TAG;
use CN\PHTML\Core\NONCONTENTTAG;
use CN\TypedArr\TypedArray;
use \InvalidArgumentException;

class ArrayTAG extends TypedArray
{
    private string $errorMessage = "Only TAG and NONCONTENTTAG objects are allowed in this array.";
    
    public function validateType(mixed $value): void
    {
        if (!$value instanceof TAG && !$value instanceof NONCONTENTTAG && !\is_string($value)) {
            throw new InvalidArgumentException($this->errorMessage);
        }
    }
}
