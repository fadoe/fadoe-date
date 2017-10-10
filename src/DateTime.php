<?php

namespace FaDoe\Date;

class DateTime extends \DateTime
{
    /**
     * Constants of days
     */
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;
    const SUNDAY = 7;

    /**
     * @var string
     */
    private $str;

    /**
     * default datetime format
     *
     * @var string
     */
    private $defaultFormat = 'Y-m-d H:i:s';

    /**
     * set date
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return self
     */
    public function setDate($year, $month, $day): self
    {
        parent::setDate($year, $month, $day);

        return $this;
    }

    /**
     * set default datetime format
     *
     * @param string $defaultFormat
     *
     * @return self
     */
    public function setDefaultFormat(string $defaultFormat): self
    {
        $this->defaultFormat = $defaultFormat;

        return $this;
    }

    /**
     * get default datetime format
     *
     * @return string
     */
    public function getDefaultFormat(): string
    {
        return $this->defaultFormat;
    }

    /**
     * get formated datetime
     *
     * @param string|null $format
     *
     * @return string
     */
    public function format($format = null): string
    {
        if (null !== $format) {
            return parent::format($format);
        }

        return parent::format($this->getDefaultFormat());
    }

    /**
     * set timezone
     *
     * @param \DateTimeZone|string $timezone
     *
     * @return self
     */
    public function setTimezone($timezone): self
    {
        if (!$timezone instanceof \DateTimeZone) {
            $timezone = new \DateTimeZone($timezone);
        }
        parent::setTimezone($timezone);

        return $this;
    }

    /**
     * get timezone
     *
     * @return DateTimeZone
     */
    public function getTimezone(): DateTimeZone
    {
        return new DateTimeZone(parent::getTimezone()->getName());
    }

    /**
     * get the first day of this week
     *
     * @return int
     */
    public function getFirstDayOfWeek(): int
    {
        $dayOfWeek = $this->format('N');
        $date = $this->copy();
        $dateInterval = new \DateInterval('P' . ($dayOfWeek - 1) . 'D');
        $date->sub($dateInterval);

        return (int) $date->format('d');
    }

    /**
     * get the last day of the week
     *
     * @return int
     */
    public function getLastDayOfWeek(): int
    {
        $dayOfWeek = $this->format('N');
        $date = $this->copy();
        $dateInterval = new \DateInterval('P' . (7 - $dayOfWeek) . 'D');
        $date->add($dateInterval);

        return (int) $date->format('d');
    }

    /**
     * get the quarter
     *
     * @return int
     */
    public function getQuarter(): int
    {
        return ceil($this->format('m') / 3);
    }

    /**
     * get the total weeks of the month
     *
     * @return int
     */
    public function getWeeksInMonth(): int
    {
        $tmpDate = $this->copy();
        $tmpDate->setDate($tmpDate->format('Y'), $tmpDate->format('m'), 1);
        $firstWeek = (int) $tmpDate->format('W');
        $lastDay = $tmpDate->format('t');
        $tmpDate->setDate($tmpDate->format('Y'), $tmpDate->format('m'), $lastDay);
        $lastWeek = (int) $tmpDate->format('W');

        if ($lastWeek < $firstWeek) {
            $tmpDate->setDate($tmpDate->format('Y'), $tmpDate->format('m'), $lastDay - 5);
            $lastWeek = (int) $tmpDate->format('W') + 1;
        }

        return ($lastWeek - $firstWeek + 1);
    }

    /**
     * get the count of weekday in month from the current date
     *
     * @return int
     */
    public function getWeekdayInMonth(): int
    {
        return (ceil($this->format('d') / 7));
    }

    /**
     * Return differences in years.
     *
     * @param null|\DateTimeInterface $from
     *
     * @return string
     */
    public function age($from = null): string
    {
        if (null === $from) {
            $from = new $this;
        }

        return $this->diff($from)->format('%r%y');
    }

    /**
     * @return bool
     */
    public function isLeapYear(): bool
    {
        return $this->format('L') == 1;
    }

    /**
     * @return bool
     */
    public function isDaylightSavings(): bool
    {
        return $this->format('I') == 1;
    }

    /**
     * @return bool
     */
    public function isWeekday(): bool
    {
        $dow = $this->format('N');

        return $dow != self::SATURDAY && $dow != self::SUNDAY;
    }

    /**
     * @return bool
     */
    public function isWeekend(): bool
    {
        return !$this->isWeekday();
    }

    /**
     * @return bool
     */
    public function isToday(): bool
    {
        $today = new self();

        return $this->format('Y-m-d') === $today->format('Y-m-d');
    }

    /**
     * @return bool
     */
    public function isTomorrow(): bool
    {
        $tomorrow = new self('tomorrow');

        return $this->format('Y-m-d') === $tomorrow->format('Y-m-d');
    }

    /**
     * @return bool
     */
    public function isYesterday(): bool
    {
        $yesterday = new self('yesterday');

        return $this->format('Y-m-d') === $yesterday->format('Y-m-d');
    }

    /**
     * @return bool
     */
    public function isPast(): bool
    {
        $today = new self();

        return $this < $today;
    }

    /**
     * @return bool
     */
    public function isFuture(): bool
    {
        $today = new self();

        return $this > $today;
    }

    /**
     * Get a clone from this date time object
     *
     * @return self
     */
    public function copy(): self
    {
        return clone $this;
    }

    /**
     * get datetime formatted
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->format();
    }

    /**
     * @return array
     */
    public function __sleep(): array
    {
        $this->str = $this->format('c');

        return ['str'];
    }

    public function __wakeup()
    {
        $this->__construct($this->str);
    }
}
