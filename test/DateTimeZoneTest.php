<?php

namespace FaDoeTest\Date;

use FaDoe\Date\DateTimeZone;
use PHPUnit\Framework\TestCase;

/**
 * Class DateTimeZoneTest
 *
 * @package FaDoeTest\Date
 */
class DateTimeZoneTest extends TestCase
{
    public function testDateTimeZoneToString(): void
    {
        $timeZone = 'Europe/Berlin';
        $this->assertEquals($timeZone, (string)(new DateTimeZone($timeZone)));
    }
}
