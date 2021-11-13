<?php

namespace FaDoe\Date\DateTimeProvider;

use DateTimeImmutable;
use FaDoe\Date\DateTimeProviderInterface;

final class SystemDateTimeProvider implements DateTimeProviderInterface
{
    public function today(): DateTimeImmutable
    {
        return new DateTimeImmutable('today');
    }

    public function tomorrow(): DateTimeImmutable
    {
        return new DateTimeImmutable('tomorrow');
    }

    public function yesterday(): DateTimeImmutable
    {
        return new DateTimeImmutable('yesterday');
    }
}