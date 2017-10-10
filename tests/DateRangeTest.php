<?php

namespace FaDoeTest\Date;

use FaDoe\Date\DateRange;
use PHPUnit\Framework\TestCase;

class DateRangeTest extends TestCase
{
    public function testRangeClassWithNoParameters()
    {
        $dateRange = new DateRange();

        $this->assertNull($dateRange->getFrom());
        $this->assertNull($dateRange->getTo());
        $this->assertNull($dateRange->getDateInterval());
        $this->assertFalse($dateRange->isInverted());
        $this->assertCount(0, $dateRange->getDates());
    }

    public function testDateTimeObjectsInRightOrder()
    {
        $date1 = new \DateTime('2013-09-01');
        $date2 = new \DateTime('2013-09-30');

        $dateRange = new DateRange($date1, $date2);

        $this->assertEquals($date1, $dateRange->getFrom());
        $this->assertEquals($date2, $dateRange->getTo());

        $this->assertFalse($dateRange->isInverted());

        $dates = $dateRange->getDates();

        $this->assertTrue(is_array($dates));
        $this->assertCount(30, $dates);
        $this->assertEquals($date1, $dates[0]);

        foreach ($dates as $date) {
            $this->assertInstanceOf(\DateTimeInterface::class, $date);
        }

        $this->assertEquals($date2, end($dates));

        $this->assertInstanceOf(\DateInterval::class, $dateRange->getDateInterval());
    }

    public function testDateTimeObjectsInInvertedOrder()
    {
        $date1 = new \DateTime('2013-09-01');
        $date2 = new \DateTime('2013-09-30');

        $dateRange = new DateRange($date2, $date1);

        $this->assertEquals($date2, $dateRange->getFrom());
        $this->assertEquals($date1, $dateRange->getTo());

        $this->assertTrue($dateRange->isInverted());

        $dates = $dateRange->getDates();

        $this->assertTrue(is_array($dates));
        $this->assertCount(30, $dates);
        $this->assertEquals($date2, $dates[0]);

        foreach ($dates as $date) {
            $this->assertInstanceOf('\DateTime', $date);
        }

        $this->assertEquals($date1, end($dates));
    }

    public function testFromAndToAreEqualDateTimeObjects()
    {
        $date1 = new \DateTime('2013-09-01');

        $dateRange = new DateRange($date1, $date1);

        $this->assertEquals($date1, $dateRange->getFrom());
        $this->assertEquals($date1, $dateRange->getTo());

        $this->assertFalse($dateRange->isInverted());

        $dates = $dateRange->getDates();

        $this->assertTrue(is_array($dates));
        $this->assertCount(1, $dates);
        $this->assertEquals($date1, $dates[0]);
    }

    public function testStringsInRightOrder()
    {
        $date1 = '2013-09-01';
        $date2 = '2013-09-30';

        $dateRange = new DateRange($date1, $date2);

        $this->assertEquals(new \DateTime($date1), $dateRange->getFrom());
        $this->assertEquals(new \DateTime($date2), $dateRange->getTo());
    }

    public function testSetterAndGetter()
    {
        $date1 = '2013-09-01';
        $date2 = '2013-09-30';

        $dateRange = new DateRange();

        $dateRange->setFrom($date1);
        $dateRange->setTo($date2);

        $this->assertEquals(new \DateTime($date1), $dateRange->getFrom());
        $this->assertEquals(new \DateTime($date2), $dateRange->getTo());
    }

    /**
     * @expectedException \FaDoe\Date\Exception\InvalidArgumentException
     */
    public function testConstructorThrowsExceptionByInvalidParameters()
    {
        $dateRange = new DateRange(array(), array());
    }

    /**
     * @expectedException \FaDoe\Date\Exception\InvalidArgumentException
     */
    public function testThrowExceptionIfSetNotADateObject()
    {
        $dateRange = new DateRange();
        $dateRange->setTo(null);
    }

    public function testIterateOverDates()
    {
        $from = '2014-04-10';
        $to = '2014-04-12';
        $dateRange = new DateRange($from, $to);

        $this->assertEquals($from, $dateRange->current()->format('Y-m-d'));
        $this->assertEquals(0, $dateRange->key());
        $dateRange->next();
        $this->assertEquals(1, $dateRange->key());
        $this->assertTrue($dateRange->valid());
        $dateRange->next();
        $dateRange->next();
        $this->assertFalse($dateRange->valid());
        $dateRange->rewind();
        $this->assertEquals($from, $dateRange->current()->format('Y-m-d'));
        $this->assertEquals(0, $dateRange->key());
    }

    /**
     * @expectedException \FaDoe\Date\Exception\InvalidArgumentException
     */
    public function testOffsetSetThrowsException()
    {
        $dateRange = new DateRange();
        $dateRange->offsetSet(0, '2014-04-13');
    }

    /**
     * @expectedException \FaDoe\Date\Exception\InvalidArgumentException
     */
    public function testOffsetUnsetThrowsException()
    {
        $dateRange = new DateRange('2014-04-12', '2014-04-13');
        $dateRange->offsetUnset(0);
    }

    public function testOffsetMethodsDefaultValues()
    {
        $dateTime = new DateRange();
        $this->assertFalse($dateTime->offsetExists(0));
        $this->assertNull($dateTime->offsetGet(0));
    }

    public function testOffsetMethodsInAction()
    {
        $dateTime = new DateRange('2014-04-12', '2014-04-14');
        $this->assertEquals('2014-04-12', $dateTime->offsetGet(0)->format('Y-m-d'));
        $this->assertTrue($dateTime->offsetExists(0));
        $this->assertEquals('2014-04-13', $dateTime->offsetGet(1)->format('Y-m-d'));
        $this->assertTrue($dateTime->offsetExists(1));
        $this->assertEquals('2014-04-14', $dateTime->offsetGet(2)->format('Y-m-d'));
        $this->assertTrue($dateTime->offsetExists(2));
    }
}
