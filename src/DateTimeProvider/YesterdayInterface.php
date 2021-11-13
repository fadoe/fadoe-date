<?php

namespace FaDoe\Date\DateTimeProvider;

use DateTimeImmutable;

interface YesterdayInterface
{
    public function yesterday(): DateTimeImmutable;
}