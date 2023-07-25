<?php

namespace FaDoe\Date;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Exception;

abstract class DateTimeUtil
{
    /**
     * get the first day of this week
     *
     * @param DateTimeInterface $dateTime
     * @return int
     * @throws Exception
     */
    public static function firstDayOfWeek(DateTimeInterface $dateTime): int
    {
        if ($dateTime instanceof DateTime) {
            $dateTime = DateTimeImmutable::createFromMutable($dateTime);
        }

        $dayOfWeek = $dateTime->format('N');
        $dateInterval = new DateInterval('P' . ($dayOfWeek - 1) . 'D');
        $date = $dateTime->sub($dateInterval);

        return (int) $date->format('d');
    }

    /**
     * get the last day of the week
     *
     * @param DateTimeInterface $dateTime
     * @return int
     * @throws Exception
     */
    public static function lastDayOfWeek(DateTimeInterface $dateTime): int
    {
        if ($dateTime instanceof DateTime) {
            $dateTime = DateTimeImmutable::createFromMutable($dateTime);
        }

        $dayOfWeek = $dateTime->format('N');
        $dateInterval = new DateInterval('P' . (7 - $dayOfWeek) . 'D');
        $dateTime = $dateTime->add($dateInterval);

        return (int) $dateTime->format('d');
    }

    /**
     * get the quarter
     *
     * @param DateTimeInterface $dateTime
     * @return int
     */
    public static function quarter(DateTimeInterface $dateTime): int
    {
        return ceil($dateTime->format('m') / 3);
    }

    /**
     * get the total weeks of the month
     *
     * @param DateTimeInterface $dateTime
     * @return int
     */
    public static function getWeeksInMonth(DateTimeInterface $dateTime): int
    {
        if ($dateTime instanceof DateTime) {
            $dateTime = DateTimeImmutable::createFromMutable($dateTime);
        }

        $firstWeek = (int) $dateTime->setDate($dateTime->format('Y'), $dateTime->format('m'), 1)->format('W');
        $lastWeek = (int) $dateTime->setDate($dateTime->format('Y'), $dateTime->format('m'), $dateTime->format('t'))->format('W');

        if ($lastWeek < $firstWeek) {
            $dateTime = $dateTime->setDate($dateTime->format('Y'), $dateTime->format('m'), $dateTime->format('t') - 5);
            $lastWeek = (int) $dateTime->format('W') + 1;
        }

        return ($lastWeek - $firstWeek + 1);
    }

    /**
     * get the count of weekday in month from the current date
     *
     * @param DateTimeInterface $dateTime
     * @return int
     */
    public static function getWeekdayInMonth(DateTimeInterface $dateTime): int
    {
        return (ceil($dateTime->format('d') / 7));
    }

    /**
     * Return differences in years.
     *
     * @param DateTimeInterface $from
     * @param DateTimeInterface|null $reference
     * @return string
     */
    public static function ageInYears(DateTimeInterface $from, DateTimeInterface $reference = null): string
    {
        if (null === $reference) {
            $reference = new DateTimeImmutable();
        }

        return $from->diff($reference)->format('%r%y');
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isLeapYear(DateTimeInterface $dateTime): bool
    {
        return $dateTime->format('L') == 1;
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isDaylightSavings(DateTimeInterface $dateTime): bool
    {
        return $dateTime->format('I');
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isWeekday(DateTimeInterface $dateTime): bool
    {
        return !in_array((int) $dateTime->format('N'), [6, 7]);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isWeekend(DateTimeInterface $dateTime): bool
    {
        return !self::isWeekday($dateTime);
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isToday(DateTimeInterface $dateTime): bool
    {
        $today = new DateTimeImmutable('today');

        return $dateTime->format('Y-m-d') === $today->format('Y-m-d');
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isTomorrow(DateTimeInterface $dateTime): bool
    {
        $tomorrow = new DateTimeImmutable('tomorrow');

        return $dateTime->format('Y-m-d') === $tomorrow->format('Y-m-d');
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isYesterday(DateTimeInterface $dateTime): bool
    {
        $yesterday = new DateTimeImmutable('yesterday');

        return $dateTime->format('Y-m-d') === $yesterday->format('Y-m-d');
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isPast(DateTimeInterface $dateTime): bool
    {
        $today = new DateTimeImmutable();

        return $dateTime < $today;
    }

    /**
     * @param DateTimeInterface $dateTime
     * @return bool
     */
    public static function isFuture(DateTimeInterface $dateTime): bool
    {
        $today = new DateTimeImmutable();

        return $dateTime > $today;
    }
}