<?php

namespace FaDoe\Date;

use FaDoe\Date\Exception\InvalidArgumentException;
use PHPUnit\Framework\TestCase;

final class MonthYearTest extends TestCase
{
    public function testCreateCurrentDate(): void
    {
        $now = date('Y-m');
        $date = MonthYear::create();
        $this->assertEquals($now, $date->toString());
        $this->assertInstanceOf(DateTimeImmutableAwareInterface::class, $date);
    }

    public function testCreateFromMonthAndYear(): void
    {
        $date = MonthYear::createFromYearAndMonth(2021, 5);

        $this->assertEquals('2021-05', $date->toString());
        $this->assertEquals('2021-05', $date->jsonSerialize());
        $this->assertEquals('2021-05', $date->toDateTimeImmutable()->format('Y-m'));
        $this->assertEquals('2021-05', (string) $date);
    }

    public function testGetLastDate(): void
    {
        $date = MonthYear::createFromYearAndMonth(2021, 2);
        $this->assertEquals('2021-02-28 00:00:00', $date->getLastDate()->format('Y-m-d H:i:s'));
    }

    public function testThrowException(): void
    {
        $this->expectException(InvalidArgumentException::class);

        MonthYear::createFromYearAndMonth(2021, 13);
        MonthYear::createFromYearAndMonth(2021, 0);
    }
}
