<?php

namespace FaDoeTest\Date;

use FaDoe\Date\DateTimeProvider;
use PHPUnit\Framework\TestCase;

class DateTimeProviderTest extends TestCase
{
    /**
     * @var DateTimeProvider
     */
    private $dateTimeProvider;

    /**
     * @var DateTimeProvider
     */
    private $dateTimeProviderFaDoeDate;

    protected function setUp()
    {
        $this->dateTimeProvider = new DateTimeProvider();
        $this->dateTimeProviderFaDoeDate = new DateTimeProvider();
        $this->dateTimeProviderFaDoeDate->setDateTimeClassName('FaDoe\Date\DateTime');
    }

    public function testGetNowDateTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->dateTimeProvider->getNow()
        );

        $this->assertInstanceOf(
            'FaDoe\Date\DateTime',
            $this->dateTimeProviderFaDoeDate->getNow()
        );
    }

    public function testGetTodayDateTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->dateTimeProvider->getToday()
        );
        $this->assertInstanceOf(
            'FaDoe\Date\DateTime',
            $this->dateTimeProviderFaDoeDate->getToday()
        );
    }

    public function testGetYesterdayDateTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->dateTimeProvider->getYesterday()
        );
        $this->assertInstanceOf(
            'FaDoe\Date\DateTime',
            $this->dateTimeProviderFaDoeDate->getYesterday()
        );
    }

    public function testGetTomorrowDateTime()
    {
        $this->assertInstanceOf(
            'DateTime',
            $this->dateTimeProvider->getTomorrow()
        );
        $this->assertInstanceOf(
            'FaDoe\Date\DateTime',
            $this->dateTimeProviderFaDoeDate->getTomorrow()
        );
    }
}
