<?php

namespace FaDoe\Date;

class DateTimeProvider 
{
    /**
     * @var string
     */
    private $dateTimeClassName = '\DateTime';

    /**
     * @var \DateTimeInterface
     */
    private $today;

    /**
     * @var \DateTimeInterface
     */
    private $yesterday;

    /**
     * @var \DateTimeInterface
     */
    private $tomorrow;

    /**
     * @param string $dateTimeClassName
     */
    public function setDateTimeClassName($dateTimeClassName)
    {
        $this->dateTimeClassName = (string) $dateTimeClassName;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getNow(): \DateTimeInterface
    {
        return $this->getDateTimeInstance();
    }

    /**
     * @return \DateTimeInterface
     */
    public function getToday(): \DateTimeInterface
    {
        if (null === $this->today) {
            $this->today = $this->getDateTimeInstance('today');
        }

        return $this->today;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getTomorrow(): \DateTimeInterface
    {
        if (null === $this->tomorrow) {
            $this->tomorrow = $this->getDateTimeInstance('tomorrow');
        }

        return $this->tomorrow;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getYesterday(): \DateTimeInterface
    {
        if (null === $this->yesterday) {
            $this->yesterday = $this->getDateTimeInstance('yesterday');
        }

        return $this->yesterday;
    }

    /**
     * @param null $parameter
     *
     * @return \DateTimeInterface
     */
    private function getDateTimeInstance($parameter = null): \DateTimeInterface
    {
        return new $this->dateTimeClassName($parameter);
    }
}
