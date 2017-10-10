<?php

namespace FaDoe\Date;

use FaDoe\Date\Exception\InvalidArgumentException;

class DateRange implements \Iterator, \ArrayAccess
{
    /**
     * @var \DateTimeInterface|null
     */
    private $from = null;

    /**
     * @var \DateTimeInterface|null
     */
    private $to = null;

    /**
     * @var array
     */
    private $dates = [];

    /**
     * @var int
     */
    private $index = 0;

    /**
     * @var bool
     */
    private $isInverted = false;

    /**
     * @param string|\DateTimeInterface $from
     * @param string|\DateTimeInterface $to
     */
    public function __construct($from = null, $to = null)
    {
        if (null !== $from) {
            $this->setFrom($from);
        }

        if (null !== $to) {
            $this->setTo($to);
        }
    }

    /**
     * Gets the interval between the two dates
     *
     * @return \DateInterval|null
     */
    public function getDateInterval()
    {
        if ((null === $this->from) && (null === $this->to)) {
            return null;
        }
        return $this->from->diff($this->to);
    }

    /**
     * Gets From
     *
     * @return \DateTimeInterface|null
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Sets From
     *
     * @param \DateTimeInterface|string $from
     *
     * @return DateRange
     * @throws Exception\InvalidArgumentException
     */
    public function setFrom($from): self
    {
        if (true === is_string($from)) {
            $from = new \DateTime($from);
        }

        if (!$from instanceof \DateTimeInterface) {
            throw InvalidArgumentException::fromInvalidType(gettype($from));
        }

        $this->from = $from;
        $this->buildDates();

        return $this;
    }

    /**
     * Gets To
     *
     * @return \DateTimeInterface|null
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Sets To
     *
     * @param \DateTimeInterface $to
     *
     * @return DateRange
     * @throws Exception\InvalidArgumentException
     */
    public function setTo($to): self
    {
        if (is_string($to)) {
            $to = new \DateTime($to);
        }

        if (!$to instanceof \DateTimeInterface) {
            throw InvalidArgumentException::fromInvalidType(gettype($to));
        }

        $this->to = $to;
        $this->buildDates();

        return $this;
    }

    /**
     * Gets dates between "from" and "to" ("from" and "to" included)
     *
     * @return array
     */
    public function getDates(): array
    {
        return $this->dates;
    }

    /**
     * If dates are in inverted order true, else false
     *
     * @return bool
     */
    public function isInverted(): bool
    {
        return $this->isInverted;
    }

    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * @return \DateTimeInterface
     */
    public function current(): \DateTimeInterface
    {
        return $this->dates[$this->index];
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->index;
    }

    public function next()
    {
        ++$this->index;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->dates[$this->index]);
    }

    /**
     * @param int            $offset
     * @param \DateTimeInterface $value
     *
     * @throws Exception\InvalidArgumentException
     */
    public function offsetSet($offset, $value)
    {
        throw new InvalidArgumentException('Setting a date is not supported.');
    }

    /**
     * @param int $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->dates[$offset]);
    }

    /**
     * @param int $offset
     *
     * @throws Exception\InvalidArgumentException
     */
    public function offsetUnset($offset)
    {
        throw new InvalidArgumentException('Unset a date is not supported.');
    }

    /**
     * @param int $offset Offset
     *
     * @return \DateTimeInterface|null
     */
    public function offsetGet($offset)
    {
        return isset($this->dates[$offset]) ? $this->dates[$offset] : null;
    }

    /**
     * create range of dates
     */
    private function buildDates()
    {
        if ((null === $this->from) || (null === $this->to)) {
            return;
        }

        $this->dates = [];

        $d = clone $this->from;
        $this->dates[] = clone $d;

        $dateInterval = new \DateInterval('P1D');

        if ($this->from <= $this->to) {
            while ($d != $this->to) {
                $d->add($dateInterval);
                $this->dates[] = clone $d;
            }
        } else {
            $this->isInverted = true;
            while ($d != $this->to) {
                $d->sub($dateInterval);
                $this->dates[] = clone $d;
            }
        }
    }

}
