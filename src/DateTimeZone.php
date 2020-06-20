<?php

namespace FaDoe\Date;

use DateTimeZone as PhpDateTimeZone;

/**
 * Class DateTimeZone
 *
 * @package FaDoe\Date
 * @psalm-immutable
 */
class DateTimeZone extends PhpDateTimeZone
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
