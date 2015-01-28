<?php
namespace FaDoeTest\Date\DateTime;

use FaDoe\Date\Compare;

class CompareTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Compare
     */
    private $compare;
    private $compareDate;
    private $dateLower;
    private $dateGreater;

    protected function setUp()
    {
        $this->compareDate = new \DateTime('2014-04-13 12:00:00');
        $this->dateLower = new \DateTime('2014-04-13 10:00:00');
        $this->dateGreater = new \DateTime('2014-04-13 13:00:00');
        $this->compare = new Compare($this->compareDate);
    }

    public function testCompareSameDate()
    {
        $this->assertFalse($this->compare->sameAs($this->dateLower));
        $this->assertFalse($this->compare->sameAs($this->dateGreater));
        $equalDateTime = new \DateTime('2014-04-13 12:00:00');
        $this->assertFalse($this->compare->sameAs($equalDateTime));
        $this->assertTrue($this->compare->sameAs($this->compareDate));
    }

    public function testCompareEqualDates()
    {
        $this->assertFalse($this->compare->equalTo($this->dateLower));
        $this->assertFalse($this->compare->equalTo($this->dateGreater));
        $this->assertTrue($this->compare->equalTo($this->compareDate));
        $equalDateTime = new \DateTime('2014-04-13 12:00:00');
        $this->assertTrue($this->compare->equalTo($equalDateTime));
    }

    public function testCompareGreaterDate()
    {
        $this->assertFalse($this->compare->greaterThen($this->dateGreater));
        $this->assertFalse($this->compare->greaterThen($this->compareDate));
        $this->assertTrue($this->compare->greaterThen($this->dateLower));
    }

    public function testCompareGreaterThenOrEqual()
    {
        $this->assertFalse($this->compare->greaterThenOrEqual($this->dateGreater));
        $this->assertTrue($this->compare->greaterThenOrEqual($this->compareDate));
        $this->assertTrue($this->compare->greaterThenOrEqual($this->dateLower));
    }

    public function testCompareLowerDate()
    {
        $this->assertFalse($this->compare->lowerThen($this->dateLower));
        $this->assertFalse($this->compare->lowerThen($this->compareDate));
        $this->assertTrue($this->compare->lowerThen($this->dateGreater));
    }

    public function testCompareLowerThenOrEqual()
    {
        $this->assertFalse($this->compare->lowerThenOrEqual($this->dateLower));
        $this->assertTrue($this->compare->lowerThenOrEqual($this->compareDate));
        $this->assertTrue($this->compare->lowerThenOrEqual($this->dateGreater));
    }

    public function testCompareBetweenEquals()
    {
        $this->assertTrue($this->compare->between($this->dateLower, $this->compareDate));
        $this->assertTrue($this->compare->between($this->compareDate, $this->dateLower));
        $this->assertTrue($this->compare->between($this->dateGreater, $this->compareDate));
        $this->assertTrue($this->compare->between($this->compareDate, $this->dateGreater));
        $lowerDate = new \DateTime('2014-04-13 09:00:00');
        $greaterDate = new \DateTime('2014-04-13 14:00:00');
        $this->assertFalse($this->compare->between($this->dateLower, $lowerDate));
        $this->assertFalse($this->compare->between($lowerDate, $this->dateLower));
        $this->assertFalse($this->compare->between($this->dateGreater, $greaterDate));
        $this->assertFalse($this->compare->between($greaterDate, $this->dateGreater));
    }

    public function testCompareBetweenNotEquals()
    {
        $this->assertFalse($this->compare->between($this->dateLower, $this->compareDate, false));
        $this->assertFalse($this->compare->between($this->compareDate, $this->dateLower, false));
        $this->assertFalse($this->compare->between($this->dateGreater, $this->compareDate, false));
        $this->assertFalse($this->compare->between($this->compareDate, $this->dateGreater, false));
        $lowerDate = new \DateTime('2014-04-13 09:00:00');
        $greaterDate = new \DateTime('2014-04-13 14:00:00');
        $this->assertFalse($this->compare->between($this->dateLower, $lowerDate, false));
        $this->assertFalse($this->compare->between($lowerDate, $this->dateLower, false));
        $this->assertFalse($this->compare->between($this->dateGreater, $greaterDate, false));
        $this->assertFalse($this->compare->between($greaterDate, $this->dateGreater, false));

        $this->assertTrue($this->compare->between($this->dateLower, $this->dateGreater));
        $this->assertTrue($this->compare->between($this->dateGreater, $this->dateLower));
    }

    public function testGetMinimumDate()
    {
        $this->assertEquals($this->dateLower, $this->compare->getMin($this->dateLower));
        $this->assertEquals($this->compareDate, $this->compare->getMin($this->dateGreater));
        $this->assertEquals($this->compareDate, $this->compare->getMin($this->compareDate));
    }

    public function testGetMaximumDate()
    {
        $this->assertEquals($this->dateGreater, $this->compare->getMax($this->dateGreater));
        $this->assertEquals($this->compareDate, $this->compare->getMax($this->dateLower));
        $this->assertEquals($this->compareDate, $this->compare->getMax($this->compareDate));
    }
}
