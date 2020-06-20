<?php

namespace FaDoe\Date;

use DateTimeInterface;

class DateTimeProvider
{
    private string $dateTimeClassName = '\DateTime';
    private ?DateTimeInterface $today = null;
    private ?DateTimeInterface $yesterday = null;
    private ?DateTimeInterface $tomorrow = null;

    /**
     * @param string $dateTimeClassName
     */
    public function setDateTimeClassName(string $dateTimeClassName): void
    {
        $this->dateTimeClassName = (string) $dateTimeClassName;
    }

    /**
     * @return DateTimeInterface
     */
    public function getNow(): DateTimeInterface
    {
        return $this->getDateTimeInstance();
    }

    /**
     * @return DateTimeInterface
     */
    public function getToday(): DateTimeInterface
    {
        if (null === $this->today) {
            $this->today = $this->getDateTimeInstance('today');
        }

        return $this->today;
    }

    /**
     * @return DateTimeInterface
     */
    public function getTomorrow(): DateTimeInterface
    {
        if (null === $this->tomorrow) {
            $this->tomorrow = $this->getDateTimeInstance('tomorrow');
        }

        return $this->tomorrow;
    }

    /**
     * @return DateTimeInterface
     */
    public function getYesterday(): DateTimeInterface
    {
        if (null === $this->yesterday) {
            $this->yesterday = $this->getDateTimeInstance('yesterday');
        }

        return $this->yesterday;
    }

    /**
     * @param string|null $parameter
     *
     * @return DateTimeInterface|object
     */
    private function getDateTimeInstance(?string $parameter = null): DateTimeInterface
    {
        return new $this->dateTimeClassName($parameter);
    }
}
