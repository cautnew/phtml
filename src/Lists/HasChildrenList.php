<?php

namespace CN\PHTML\Lists;

use CN\PHTML\ArrayTAG;
use InvalidArgumentException;

/**
 * Trait HasChildrenList
 *
 * Gives a tag the ability to receive a list of children that are validated
 * against the CHILDREN constant of the using class.
 */
trait HasChildrenList
{
    /**
     * Get the tag classes accepted as children.
     *
     * @return string[]
     */
    public static function allowedChildren(): array
    {
        return static::CHILDREN;
    }

    /**
     * Append every element of a list as a child.
     *
     * @param iterable $items Array or ArrayTAG of allowed child tags.
     * @throws InvalidArgumentException If an item is not an allowed child.
     */
    public function setItems(iterable $items): static
    {
        foreach ($items as $item) {
            $this->addItem($item);
        }

        return $this;
    }

    /**
     * Append one child, checking that it is allowed in this tag.
     *
     * @param mixed $item Child tag.
     * @throws InvalidArgumentException If the item is not an allowed child.
     */
    public function addItem(mixed $item): static
    {
        foreach (static::CHILDREN as $allowed) {
            if ($item instanceof $allowed) {
                return $this->append($item);
            }
        }

        $given = is_object($item) ? $item::class : get_debug_type($item);
        $allowedList = implode(', ', array_map(fn (string $c) => substr(strrchr('\\' . $c, '\\'), 1), static::CHILDREN));

        throw new InvalidArgumentException(sprintf(
            '%s only accepts %s as children, %s given.',
            static::class,
            $allowedList,
            $given
        ));
    }

    /**
     * Build an ArrayTAG already restricted to the allowed children.
     *
     * @param array $items Allowed child tags.
     * @throws InvalidArgumentException If an item is not an allowed child.
     */
    public static function newList(array $items = []): ArrayTAG
    {
        return new class (static::CHILDREN, $items) extends ArrayTAG {
            public function __construct(private array $allowed, array $items = [])
            {
                parent::__construct($items);
            }

            public function validateType(mixed $value): void
            {
                foreach ($this->allowed as $class) {
                    if ($value instanceof $class) {
                        return;
                    }
                }

                throw new InvalidArgumentException('Item is not an allowed child: ' . get_debug_type($value));
            }
        };
    }
}
