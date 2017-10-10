<?php

namespace FaDoe\Date;

class DateTimeZone extends \DateTimeZone
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }
}
