<?php
namespace FaDoe\Date;

class Compare
{
    /**
     * @var \DateTime
     */
    private $compareDate;

    /**
     * @param \DateTime $compareDate
     */
    public function __construct(\DateTime $compareDate)
    {
        $this->compareDate = $compareDate;
    }

    /**
     * Assert that DateTime object the same to compare date.
     *
     * @param \DateTime $dateTime
     *
     * @return bool
     */
    public function sameAs(\DateTime $dateTime)
    {
        return $this->compareDate === $dateTime;
    }

    /**
     * Assert that DateTime object equal to compare date.
     *
     * @param \DateTime $date
     *
     * @return bool
     */
    public function equalTo(\DateTime $date)
    {
        return $this->compareDate == $date;
    }

    /**
     * Assert that DateTime object lower then compare date.
     *
     * @param \DateTime $date
     *
     * @return bool
     */
    public function greaterThen(\DateTime $date)
    {
        return $this->compareDate > $date;
    }

    /**
     * Assert that DateTime object lower or equal then compare date.
     *
     * @param \DateTime $dateTime
     *
     * @return bool
     */
    public function greaterThenOrEqual(\DateTime $dateTime)
    {
        return $this->compareDate >= $dateTime;
    }

    /**
     * Assert that DateTime object greater then compare date.
     *
     * @param \DateTime $dateTime
     *
     * @return bool
     */
    public function lowerThen(\DateTime $dateTime)
    {
        return $this->compareDate < $dateTime;
    }

    /**
     * Assert that DateTime object greater or equal to compare date.
     *
     * @param \DateTime $dateTime
     *
     * @return bool
     */
    public function lowerThenOrEqual(\DateTime $dateTime)
    {
        return $this->compareDate <= $dateTime;
    }

    /**
     * Assert that compare date between from and to date.
     *
     * If equal to false the compare date is not equal to start or end date.
     *
     * @param \DateTime $from
     * @param \DateTime $to
     * @param bool      $equal
     *
     * @return bool
     */
    public function between(\DateTime $from, \DateTime $to, $equal = true)
    {
        if ($from > $to) {
            $tmp = $from;
            $from = $to;
            $to = $tmp;
        }

        if ($equal) {
            return $this->greaterThenOrEqual($from) && $this->lowerThenOrEqual($to);
        }

        return $this->greaterThen($from) && $this->lowerThen($to);
    }

    /**
     * Get min date.
     *
     * @param \DateTime $dateTime
     *
     * @return \DateTime
     */
    public function getMin(\DateTime $dateTime)
    {
        return $this->lowerThen($dateTime) ? $this->compareDate : $dateTime;
    }

    /**
     * Get max date.
     *
     * @param \DateTime $dateTime
     *
     * @return \DateTime
     */
    public function getMax(\DateTime $dateTime)
    {
        return $this->lowerThen($dateTime) ? $dateTime : $this->compareDate;
    }

}
