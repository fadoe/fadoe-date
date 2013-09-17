<?php

namespace FaDoeTest\Date;

use PHPUnit_Framework_TestCase as TestCase;
use FaDoe\Date\DateTimeZone;

class DateTimeZoneTest extends TestCase
{

    public function testDateTimeZoneToString()
    {
        $dateTime = new DateTimeZone('Europe/Berlin');

        $this->assertEquals((string) $dateTime, 'Europe/Berlin');
    }

}
