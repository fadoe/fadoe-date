<?php

namespace FaDoe\Date;

use PHPUnit\Framework\TestCase;

final class TimestampTest extends TestCase
{
    public function testCreate(): void
    {
        $now = date('Y-m-d H:i');
        $date = Timestamp::create();
        $this->assertEquals($now, $date->toDateTimeImmutable()->format('Y-m-d H:i'));
        $this->assertInstanceOf(DateTimeImmutableAwareInterface::class, $date);
    }

    public function testCreateFromTimestamp(): void
    {
        $date = new \DateTimeImmutable();
        $timestamp = Timestamp::createFromDateTimeImmutable($date);

        $this->assertEquals($date, $timestamp->toDateTimeImmutable());

        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), $timestamp->jsonSerialize());
        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), $timestamp->toString());
        $this->assertEquals($date->format($timestamp::TO_STRING_FORMAT), (string) $timestamp);
    }
}
