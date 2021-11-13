<?php

namespace FaDoe\Date\DateTimeProvider;

use DateTimeImmutable;

interface TomorrowInterface
{
    public function tomorrow(): DateTimeImmutable;
}