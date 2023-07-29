<?php

declare(strict_types=1);

namespace FaDoe\Date;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateTimeUtil::class)]
final class DateTimeUtilTest extends TestCase
{
    public function testFirstDayOfWeek(): void
    {
        $dateTime = new DateTime('2012-10-24');
        $this->assertEquals(22, DateTimeUtil::firstDayOfWeek($dateTime));
        $dateTime = new DateTimeImmutable('2012-10-29');
        $this->assertEquals(29, DateTimeUtil::firstDayOfWeek($dateTime));
    }

    public function testLastDayOfWeek(): void
    {
        $dateTime = new DateTime('2012-10-24');
        $this->assertEquals(28, DateTimeUtil::lastDayOfWeek($dateTime));
        $dateTime = new DateTimeImmutable('2012-10-29');
        $this->assertEquals(4, DateTimeUtil::lastDayOfWeek($dateTime));
    }

    public function testQuarter(): void
    {
        $dateTime = new DateTime('2012-02-12');
        $this->assertEquals(1, DateTimeUtil::quarter($dateTime));
        $dateTime = new DateTime('2012-04-12');
        $this->assertEquals(2, DateTimeUtil::quarter($dateTime));
        $dateTime = new DateTimeImmutable('2012-07-12');
        $this->assertEquals(3, DateTimeUtil::quarter($dateTime));
        $dateTime = new DateTimeImmutable('2012-10-12');
        $this->assertEquals(4, DateTimeUtil::quarter($dateTime));
    }

    public function testWeeksInMonth(): void
    {
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(5, DateTimeUtil::getWeeksInMonth($dateTime));
        $dateTime = new DateTimeImmutable('2012-12-13');
        $this->assertEquals(6, DateTimeUtil::getWeeksInMonth($dateTime));
    }

    public function testWeekdayInMonth(): void
    {
        $dateTime = new DateTime('2012-10-29');
        $this->assertEquals(5, DateTimeUtil::getWeekdayInMonth($dateTime));
        $dateTime = new DateTimeImmutable('2012-10-08');
        $this->assertEquals(2, DateTimeUtil::getWeekdayInMonth($dateTime));
    }

    public function testAge(): void
    {
        $date = new DateTime();
        $refDate = clone $date;
        $date1 = new DateTime('2010-10-10');
        $refDate1 = clone $date1;
        $date2 = new DateTime('2013-10-31');
        $refDate2 = clone $date2;

        $this->assertEquals(0, DateTimeUtil::ageInYears($date));
        $this->assertEquals(3, DateTimeUtil::ageInYears($date1, $date2));
        $this->assertEquals(-3, DateTimeUtil::ageInYears($date2, $date1));

        $this->assertEquals($refDate, $date);
        $this->assertEquals($refDate1, $date1);
        $this->assertEquals($refDate2, $date2);
    }

    public function testLeapYears(): void
    {
        $dateLeapYear = new DateTime('2000-01-01');
        $this->assertTrue(DateTimeUtil::isLeapYear($dateLeapYear));
        $dateNoLeapYear = new DateTime('2013-01-01');
        $this->assertFalse(DateTimeUtil::isLeapYear($dateNoLeapYear));
    }

    public function testIsDayLightSavingTime(): void
    {
        $date = (new DateTime('2014-02-01'))->setTimezone(new DateTimeZone('UTC'));
        $this->assertFalse(DateTimeUtil::isDaylightSavings($date));
        $date->setTimezone(new DateTimeZone('Europe/Berlin'));
        $this->assertFalse(DateTimeUtil::isDaylightSavings($date));

        $dateDLS = (new DateTime('2014-08-15'))->setTimezone(new DateTimeZone('UTC'));
        $this->assertFalse(DateTimeUtil::isDaylightSavings($dateDLS));
        $dateDLS->setTimezone(new DateTimeZone('Europe/Berlin'));
        $this->assertTrue(DateTimeUtil::isDaylightSavings($dateDLS));
    }

    public function testDateIsWeekday(): void
    {
        $dateWeekday = new DateTime('2014-05-02');
        $dateWeekend = new DateTime('2014-05-03');
        $this->assertTrue(DateTimeUtil::isWeekday($dateWeekday));
        $this->assertFalse(DateTimeUtil::isWeekday($dateWeekend));
    }

    public function testDateIsWeekend(): void
    {
        $dateWeekday = new DateTime('2014-05-02');
        $dateWeekend = new DateTime('2014-05-03');
        $this->assertTrue(DateTimeUtil::isWeekend($dateWeekend));
        $this->assertFalse(DateTimeUtil::isWeekend($dateWeekday));
    }

    public function testDateIsToday(): void
    {
        $today = new DateTime();
        $this->assertTrue(DateTimeUtil::isToday($today));
        $today->add(new DateInterval('P1D'));
        $this->assertFalse(DateTimeUtil::isToday($today));
    }

    public function testDateIsTomorrow(): void
    {
        $today = new DateTime();
        $this->assertFalse(DateTimeUtil::isTomorrow($today));
        $today->add(new DateInterval('P1D'));
        $this->assertTrue(DateTimeUtil::isTomorrow($today));
    }

    public function testDateIsYesterday(): void
    {
        $today = new DateTime();
        $this->assertFalse(DateTimeUtil::isYesterday($today));
        $today->sub(new DateInterval('P1D'));
        $this->assertTrue(DateTimeUtil::isYesterday($today));
    }

    public function testDateIsPast(): void
    {
        $interval = DateInterval::createFromDateString('1 minutes');
        $today = (new DateTime())->add($interval);
        $this->assertFalse(DateTimeUtil::isPast($today));
        $today = (new DateTime())->sub($interval);
        $this->assertTrue(DateTimeUtil::isPast($today));
    }

    public function testDateIsFuture(): void
    {
        $interval = DateInterval::createFromDateString('1 minutes');
        $today = (new DateTime())->sub($interval);
        $this->assertFalse(DateTimeUtil::isFuture($today));
        $today = (new DateTime())->add($interval);
        $this->assertTrue(DateTimeUtil::isFuture($today));
    }
}
