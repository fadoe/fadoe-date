<?php

namespace FaDoe\Date;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class TimestampTest extends TestCase
{
    private const COMPARE_DATE_FORMAT = 'Y-m-d H:i';

    public function testCreate(): void
    {
        $date = new DateTimeImmutable();
        $timestamp = Timestamp::create();

        $this->assertInstanceOf(DateTimeImmutableAwareInterface::class, $timestamp);
        $this->assertEquals(
            $date->format(self::COMPARE_DATE_FORMAT),
            $timestamp->toDateTimeImmutable()->format(self::COMPARE_DATE_FORMAT)
        );
    }

    public function testCreateFromTimestamp(): void
    {
        $date = new DateTimeImmutable();
        $timestamp = Timestamp::createFromDateTimeImmutable($date);

        $this->assertEquals($date, $timestamp->toDateTimeImmutable());

        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), $timestamp->jsonSerialize());
        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), $timestamp->toString());
        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), (string) $timestamp);
    }
}
