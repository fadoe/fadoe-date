<?php

namespace FaDoe\Date\DateTimeProvider;

use PHPUnit\Framework\TestCase;

final class SystemDateTimeProviderTest extends TestCase
{
    public function testSystemDateTimeProvider(): void
    {
        $today = (new \DateTimeImmutable())->setTime(0, 0);
        $tomorrow = (new \DateTimeImmutable('tomorrow'));
        $yesterday = (new \DateTimeImmutable('yesterday'));

        $provider = new SystemDateTimeProvider();

        $this->assertEquals($today, $provider->today());
        $this->assertEquals($tomorrow, $provider->tomorrow());
        $this->assertEquals($yesterday, $provider->yesterday());
    }
}
