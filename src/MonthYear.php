<?php

declare(strict_types=1);

namespace FaDoe\Date;

use DateTimeImmutable;
use JsonSerializable;
use Stringable;

final class MonthYear implements JsonSerializable, Stringable, DateTimeImmutableAwareInterface
{
    private DateTimeImmutable $dateTime;
    public const TO_STRING_FORMAT = 'Y-m';

    public static function create(): self
    {
        return new self(new DateTimeImmutable());
    }

    public static function createFromYearAndMonth(int $year, int $month): self
    {
        if ($month < 1 || $month > 12) {
            throw Exception\InvalidArgumentException::fromMonth($month);
        }

        return new self(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', "$year-$month-01 00:00:00"));
    }

    public function getLastDate(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $this->dateTime->format('Y-m-t H:i:s'));
    }

    public function jsonSerialize(): string
    {
        return (string) $this;
    }

    public function toDateTimeImmutable(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function toString(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->dateTime->format(self::TO_STRING_FORMAT);
    }

    private function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $this->dateTime = $dateTimeImmutable;
    }
}
