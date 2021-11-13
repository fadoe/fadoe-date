<?php

namespace FaDoe\Date\DateTimeProvider;

use DateTimeImmutable;

interface TodayInterface
{
    public function today(): DateTimeImmutable;
}
