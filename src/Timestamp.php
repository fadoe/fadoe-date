<?php

declare(strict_types=1);

namespace FaDoe\Date;

use DateTimeImmutable;
use JsonSerializable;
use Stringable;

final class Timestamp implements JsonSerializable, Stringable, DateTimeImmutableAwareInterface
{
    private DateTimeImmutable $timestamp;
    public const TO_STRING_FORMAT = DATE_ATOM;

    public static function create(): self
    {
        return new self(new DateTimeImmutable());
    }

    public static function createFromDateTimeImmutable(DateTimeImmutable $dateTimeImmutable): self
    {
        return new self($dateTimeImmutable);
    }

    public function jsonSerialize(): string
    {
        return (string) $this;
    }

    public function toDateTimeImmutable(): DateTimeImmutable
    {
        return $this->timestamp;
    }

    public function toString(): string
    {
        return (string) $this;
    }

    public function __toString(): string
    {
        return $this->timestamp->format(self::TO_STRING_FORMAT);
    }

    private function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $this->timestamp = $dateTimeImmutable;
    }
}