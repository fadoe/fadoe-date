<?php

namespace FaDoe\Date\DateTimeProvider;

use DateTimeImmutable;
use FaDoe\Date\DateTimeProviderInterface;
use PHPUnit\Framework\TestCase;

final class DateTimeProviderTest extends TestCase
{
    public function testDateTimeProvider(): void
    {
        $time = new DateTimeImmutable();
        $provider = new DateTimeProvider($time);

        $this->assertInstanceOf(DateTimeProviderInterface::class, $provider);

        $this->assertEquals($time->setTime(0, 0), $provider->today());
        $this->assertEquals(new DateTimeImmutable('tomorrow'), $provider->tomorrow());
        $this->assertEquals(new DateTimeImmutable('yesterday'), $provider->yesterday());
    }

    public function testGetNowDateTime()
    {
        $today = new DateTimeImmutable('2021-12-13');
        $yesterday = new DateTimeImmutable('2021-12-12 00:00:00');
        $tomorrow = new DateTimeImmutable('2021-12-14 00:00:00');
        $provider = new DateTimeProvider($today);

        $this->assertEquals($today, $provider->today());
        $this->assertEquals($yesterday, $provider->yesterday());
        $this->assertEquals($tomorrow, $provider->tomorrow());
    }
}
