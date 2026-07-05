<?php

namespace CN\PHTML;

use CN\PHTML\Core\TAG;
use CN\PHTML\Core\NONCONTENTTAG;
use \ArrayAccess;
use \ArrayIterator;
use \Countable;
use \IteratorAggregate;
use \InvalidArgumentException;
use \Traversable;

class TAGArray implements ArrayAccess, Countable, IteratorAggregate
{
    private array $items = [];

    public function offsetExists($offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet($offset, $value): void
    {
        // Validação de tipo
        if (!$value instanceof TAG && !$value instanceof NONCONTENTTAG) {
            throw new InvalidArgumentException(
                "Apenas objetos do tipo PHTML são permitidos."
            );
        }

        if ($offset === null) {
            $this->items[] = $value;
        } else {
            $this->items[$offset] = $value;
        }
    }

    public function offsetUnset($offset): void
    {
        unset($this->items[$offset]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }
}
