<?php

namespace FaDoe\Date\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @param string $type
     *
     * @return InvalidArgumentException
     */
    public static function fromInvalidType(string $type)
    {
        return new self(sprintf('Parameter must be a string or DateTime object, %s given.', $type));
    }
}
