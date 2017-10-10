<?php

namespace FaDoeTest\Date\DateTime;

use FaDoe\Date\DateTime;
use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{

    public function testChangingDefaultDateFormat()
    {
        $dateTime = new DateTime('13.04.2014 10:10:10');
        $this->assertEquals('2014-04-13 10:10:10', $dateTime->format());
        $dateTime->setDefaultFormat('d.m.Y H:i:s');
        $this->assertEquals('13.04.2014 10:10:10', $dateTime->format());
    }

    public function testCastClassToString()
    {
        $dateTime = new DateTime('2014-04-13');
        $this->assertEquals('2014-04-13 00:00:00', (string) $dateTime);
    }

    public function testQuarter()
    {
        $dateTime = new DateTime('2012-02-12');
        $this->assertEquals(1, $dateTime->getQuarter());
        $dateTime = new DateTime('2012-04-12');
        $this->assertEquals(2, $dateTime->getQuarter());
        $dateTime = new DateTime('2012-07-12');
        $this->assertEquals(3, $dateTime->getQuarter());
        $dateTime = new DateTime('2012-10-12');
        $this->assertEquals(4, $dateTime->getQuarter());
    }

    public function testWeeksInMonth()
    {
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(5, $dateTime->getWeeksInMonth());
        $dateTime = new DateTime('2012-12-13');
        $this->assertEquals(6, $dateTime->getWeeksInMonth());
    }

    public function testWeekdayInMonth()
    {
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(5, $dateTime->getWeekdayInMonth());
        $dateTime = new DateTime('2012-10-08');
        $this->assertEquals(2, $dateTime->getWeekdayInMonth());
    }

    public function testFirstDayOfWeek()
    {
        $dateTime = new DateTime('2012-10-24');
        $this->assertEquals(22, $dateTime->getFirstDayOfWeek());
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(29, $dateTime->getFirstDayOfWeek());
    }

    public function testLastDayOfWeek()
    {
        $dateTime = new DateTime('2012-10-24');
        $this->assertEquals(28, $dateTime->getLastDayOfWeek());
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(4, $dateTime->getLastDayOfWeek());
    }

    public function testSleepWakeUp()
    {
        $date = new DateTime('2012-10-12');
        $string = serialize($date);
        $date2 = unserialize($string);
        $this->assertEquals($date->format(), $date2->format());

    }

    public function testAge()
    {
        $date = new DateTime();
        $date1 = new DateTime('2010-10-10');
        $date2 = new DateTime('2013-10-31');

        $this->assertEquals(0, $date->age());
        $this->assertEquals(3, $date1->age($date2));
        $this->assertEquals(-3, $date2->age($date1));
    }

    public function testTimezone()
    {
        $date = new DateTime();
        $date->setTimezone('Europe/Berlin');
        $this->assertEquals('Europe/Berlin', $date->getTimezone());
    }

    public function testLeapYears()
    {
        $dateLeapYear = new DateTime('2000-01-01');
        $this->assertTrue($dateLeapYear->isLeapYear());
        $dateNoLeapYear = new DateTime('2013-01-01');
        $this->assertFalse($dateNoLeapYear->isLeapYear());
    }

    public function testIsDayLightSavingTime()
    {
        $date = new DateTime('2014-02-01');
        $this->assertFalse($date->isDaylightSavings());
        $dateDLS = new DateTime('2014-03-31');
        $this->assertTrue($dateDLS->isDaylightSavings());
    }

    public function testDateIsWeekday()
    {
        $dateWeekday = new DateTime('2014-05-02');
        $dateWeekend = new DateTime('2014-05-03');
        $this->assertTrue($dateWeekday->isWeekday());
        $this->assertFalse($dateWeekend->isWeekday());
    }

    public function testDateIsWeekEnd()
    {
        $dateWeekday = new DateTime('2014-05-02');
        $dateWeekend = new DateTime('2014-05-03');
        $this->assertTrue($dateWeekend->isWeekend());
        $this->assertFalse($dateWeekday->isWeekend());
    }

    public function testDateIsYesterday()
    {
        $today = new DateTime();
        $this->assertFalse($today->isYesterday());
        $today->sub(new \DateInterval('P1D'));
        $this->assertTrue($today->isYesterday());
    }

    public function testDateIsTomorrow()
    {
        $today = new DateTime();
        $this->assertFalse($today->isTomorrow());
        $today->add(new \DateInterval('P1D'));
        $this->assertTrue($today->isTomorrow());
    }

    public function testDateIsToday()
    {
        $today = new DateTime();
        $this->assertTrue($today->isToday());
        $today->add(new \DateInterval('P1D'));
        $this->assertFalse($today->isToday());
    }

    public function testDateIsFuture()
    {
        $today = new DateTime();
        $this->assertFalse($today->isFuture());
        $today->add(new \DateInterval('P1D'));
        $this->assertTrue($today->isFuture());
    }

    public function testDateIsPast()
    {
        $today = new DateTime();
        $this->assertFalse($today->isPast());
        sleep(1);
        $this->assertTrue($today->isPast());
    }
}
