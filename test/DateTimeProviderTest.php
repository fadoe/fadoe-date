<?php

namespace FaDoeTest\Date;

use DateTime as PhpDateTime;
use FaDoe\Date\DateTime as FaDoeDateTime;
use FaDoe\Date\DateTimeProvider;
use PHPUnit\Framework\TestCase;

/**
 * Class DateTimeProviderTest
 *
 * @package FaDoeTest\Date
 */
class DateTimeProviderTest extends TestCase
{
    private DateTimeProvider $dateTimeProvider;
    private DateTimeProvider $dateTimeProviderFaDoeDate;

    protected function setUp(): void
    {
        $this->dateTimeProvider = new DateTimeProvider();
        $this->dateTimeProviderFaDoeDate = new DateTimeProvider();
        $this->dateTimeProviderFaDoeDate->setDateTimeClassName('FaDoe\Date\DateTime');
    }

    public function testGetNowDateTime(): void
    {
        $this->assertInstanceOf(PhpDateTime::class, $this->dateTimeProvider->getNow());
        $this->assertInstanceOf(FaDoeDateTime::class, $this->dateTimeProviderFaDoeDate->getNow());
    }

    public function testGetTodayDateTime(): void
    {
        $this->assertInstanceOf(PhpDateTime::class, $this->dateTimeProvider->getToday());
        $this->assertInstanceOf(FaDoeDateTime::class, $this->dateTimeProviderFaDoeDate->getToday());
    }

    public function testGetYesterdayDateTime(): void
    {
        $this->assertInstanceOf(PhpDateTime::class, $this->dateTimeProvider->getYesterday());
        $this->assertInstanceOf(FaDoeDateTime::class, $this->dateTimeProviderFaDoeDate->getYesterday());
    }

    public function testGetTomorrowDateTime(): void
    {
        $this->assertInstanceOf(PhpDateTime::class, $this->dateTimeProvider->getTomorrow());
        $this->assertInstanceOf(FaDoeDateTime::class, $this->dateTimeProviderFaDoeDate->getTomorrow());
    }
}
