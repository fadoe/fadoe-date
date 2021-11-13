<?php

namespace FaDoe\Date;

use FaDoe\Date\DateTimeProvider;

interface DateTimeProviderInterface extends
    DateTimeProvider\TodayInterface,
    DateTimeProvider\TomorrowInterface,
    DateTimeProvider\YesterdayInterface
{
}
