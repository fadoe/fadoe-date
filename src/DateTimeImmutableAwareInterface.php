<?php

namespace FaDoe\Date;

use DateTimeImmutable;

interface DateTimeImmutableAwareInterface
{
    public function toDateTimeImmutable(): DateTimeImmutable;
}