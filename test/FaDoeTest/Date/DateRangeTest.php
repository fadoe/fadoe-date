<?php
/**
 * Created by JetBrains PhpStorm.
 * User: falk
 * Date: 17.09.13
 * Time: 22:29
 * To change this template use File | Settings | File Templates.
 */

namespace FaDoeTest\Date;


use FaDoe\Date\DateRange;

class DateRangeTest extends \PHPUnit_Framework_TestCase
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
            $this->assertInstanceOf('\DateTime', $date);
        }

        $this->assertEquals($date2, end($dates));

        $this->assertInstanceOf('\DateInterval', $dateRange->getDateInterval());
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

}
