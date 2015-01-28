<?php
namespace FaDoeTest\Date;

use PHPUnit_Framework_TestCase as TestCase;
use FaDoe\Date\DateTimeZone;

class DateTimeZoneTest extends TestCase
{
    public function testDateTimeZoneToString()
    {
        $timeZone = 'Europe/Berlin';
        $dateTime = new DateTimeZone($timeZone);
        $this->assertEquals($timeZone, (string) $dateTime);
    }
}
