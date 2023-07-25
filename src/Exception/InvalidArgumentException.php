<?php

namespace FaDoe\Date\Exception;

class InvalidArgumentException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * @param string $type
     *
     * @return InvalidArgumentException
     */
    public static function fromInvalidType(string $type): self
    {
        return new self(sprintf('Parameter must be a string or DateTime object, %s given.', $type));
    }

    public static function fromMonth(int $month): self
    {
        return new self(sprintf('Month %d is not in 1 and 12.', $month ));
    }
}
