<?php

namespace FaDoe\Date\DateTimeProvider;

use DateInterval;
use DateTimeImmutable;
use FaDoe\Date\DateTimeProviderInterface;

final class DateTimeProvider implements DateTimeProviderInterface
{
    private DateTimeImmutable $dateTimeImmutable;

    public function __construct(DateTimeImmutable $dateTimeImmutable)
    {
        $dateTimeImmutable = $dateTimeImmutable->setTime(0, 0);
        $this->dateTimeImmutable = $dateTimeImmutable;
    }
    public function today(): DateTimeImmutable
    {
        return $this->dateTimeImmutable;
    }

    public function tomorrow(): DateTimeImmutable
    {
        return $this->dateTimeImmutable->add(DateInterval::createFromDateString('1 days'));
    }

    public function yesterday(): DateTimeImmutable
    {
        return $this->dateTimeImmutable->sub(DateInterval::createFromDateString('1 days'));
    }
}