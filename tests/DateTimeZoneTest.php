<?php

namespace FaDoeTest\Date;

use FaDoe\Date\DateTimeZone;
use PHPUnit\Framework\TestCase;

class DateTimeZoneTest extends TestCase
{
    public function testDateTimeZoneToString()
    {
        $timeZone = 'Europe/Berlin';
        $dateTime = new DateTimeZone($timeZone);
        $this->assertEquals($timeZone, (string) $dateTime);
    }
}
