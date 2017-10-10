<?php

namespace FaDoeTest\Date\DateTime;

use FaDoe\Date\Compare;
use PHPUnit\Framework\TestCase;

class CompareTest extends TestCase
{
    /**
     * @var Compare
     */
    private $compare;

    /**
     * @var \DateTimeInterface
     */
    private $compareDate;

    /**
     * @var \DateTimeInterface
     */
    private $betweenDateLower;

    /**
     * @var \DateTimeInterface
     */
    private $betweenDateGreater;

    /**
     * @var \DateTimeInterface
     */
    private $dateLower;

    /**
     * @var \DateTimeInterface
     */
    private $dateGreater;

    protected function setUp()
    {
        $this->compareDate = new \DateTime('2014-04-13 12:00:00');
        $this->betweenDateLower = new \DateTime('2014-04-13 10:00:00');
        $this->betweenDateGreater = new \DateTime('2014-04-13 13:00:00');
        $this->dateLower = new \DateTime('2014-04-13 09:00:00');
        $this->dateGreater = new \DateTime('2014-04-13 14:00:00');

        $this->compare = new Compare($this->compareDate);
    }

    public function testCompareSameDate()
    {
        $this->assertFalse($this->compare->sameAs($this->betweenDateLower));
        $this->assertFalse($this->compare->sameAs($this->betweenDateGreater));
        $equalDateTime = new \DateTime('2014-04-13 12:00:00');
        $this->assertFalse($this->compare->sameAs($equalDateTime));
        $this->assertTrue($this->compare->sameAs($this->compareDate));
    }

    public function testCompareEqualDates()
    {
        $this->assertFalse($this->compare->equalTo($this->betweenDateLower));
        $this->assertFalse($this->compare->equalTo($this->betweenDateGreater));
        $this->assertTrue($this->compare->equalTo($this->compareDate));
        $equalDateTime = new \DateTime('2014-04-13 12:00:00');
        $this->assertTrue($this->compare->equalTo($equalDateTime));
    }

    public function testCompareGreaterDate()
    {
        $this->assertFalse($this->compare->greaterThen($this->betweenDateGreater));
        $this->assertFalse($this->compare->greaterThen($this->compareDate));
        $this->assertTrue($this->compare->greaterThen($this->betweenDateLower));
    }

    public function testCompareGreaterThenOrEqual()
    {
        $this->assertFalse($this->compare->greaterThenOrEqual($this->betweenDateGreater));
        $this->assertTrue($this->compare->greaterThenOrEqual($this->compareDate));
        $this->assertTrue($this->compare->greaterThenOrEqual($this->betweenDateLower));
    }

    public function testCompareLowerDate()
    {
        $this->assertFalse($this->compare->lowerThen($this->betweenDateLower));
        $this->assertFalse($this->compare->lowerThen($this->compareDate));
        $this->assertTrue($this->compare->lowerThen($this->betweenDateGreater));
    }

    public function testCompareLowerThenOrEqual()
    {
        $this->assertFalse($this->compare->lowerThenOrEqual($this->betweenDateLower));
        $this->assertTrue($this->compare->lowerThenOrEqual($this->compareDate));
        $this->assertTrue($this->compare->lowerThenOrEqual($this->betweenDateGreater));
    }

    public function testCompareBetweenGreaterFromLowerTo()
    {
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->betweenDateGreater, Compare::GT_FROM_LT_TO));
        $this->assertTrue($this->compare->between($this->betweenDateGreater, $this->betweenDateLower, Compare::GT_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->compareDate, $this->betweenDateGreater, Compare::GT_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->betweenDateLower, $this->compareDate, Compare::GT_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->dateLower, $this->betweenDateLower, Compare::GT_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->betweenDateGreater, $this->dateGreater, Compare::GT_FROM_LT_TO));
    }

    public function testCompareBetweenGreaterFromLowerEqualsTo()
    {
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->compareDate, Compare::GT_FROM_LTEQ_TO));
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->betweenDateGreater, Compare::GT_FROM_LTEQ_TO));
        $this->assertFalse($this->compare->between($this->compareDate, $this->betweenDateLower, Compare::GT_FROM_LTEQ_TO));
        $this->assertFalse($this->compare->between($this->compareDate, $this->betweenDateGreater, Compare::GT_FROM_LTEQ_TO));
        $this->assertFalse($this->compare->between($this->betweenDateGreater, $this->dateGreater, Compare::GT_FROM_LTEQ_TO));
    }

    public function testCompareBetweenGreaterEqualsFromLowerTo()
    {
        $this->assertTrue($this->compare->between($this->compareDate, $this->betweenDateGreater, Compare::GTEQ_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->dateLower, $this->betweenDateLower, Compare::GTEQ_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->betweenDateGreater, $this->compareDate, Compare::GTEQ_FROM_LT_TO));
        $this->assertFalse($this->compare->between($this->betweenDateLower, $this->compareDate, Compare::GTEQ_FROM_LT_TO));
    }

    public function testCompareBetweenGreaterEqualsFromLowerEqualsTo()
    {
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->compareDate, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertTrue($this->compare->between($this->compareDate, $this->betweenDateGreater, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->betweenDateGreater, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertTrue($this->compare->between($this->betweenDateGreater, $this->betweenDateLower, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->compareDate));
        $this->assertTrue($this->compare->between($this->compareDate, $this->betweenDateGreater));
        $this->assertTrue($this->compare->between($this->betweenDateLower, $this->betweenDateGreater));
        $this->assertTrue($this->compare->between($this->betweenDateGreater, $this->betweenDateLower));

        $compare = new Compare($this->dateLower);
        $this->assertFalse($compare->between($this->betweenDateLower, $this->betweenDateGreater, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertFalse($compare->between($this->betweenDateLower, $this->betweenDateGreater));

        $compare = new Compare($this->dateGreater);
        $this->assertFalse($compare->between($this->betweenDateLower, $this->betweenDateGreater, Compare::GTEQ_FROM_LTEQ_TO));
        $this->assertFalse($compare->between($this->betweenDateLower, $this->betweenDateGreater));
    }

    /**
     * @expectedException \FaDoe\Date\Exception\InvalidArgumentException
     */
    public function testCompareBetweenThrowsInvalidArgumentExceptionForInvalidCompareArgument()
    {
        $this->compare->between($this->betweenDateLower, $this->betweenDateGreater, 100);
    }

    public function testGetMinimumDate()
    {
        $this->assertEquals($this->betweenDateLower, $this->compare->getMin($this->betweenDateLower));
        $this->assertEquals($this->compareDate, $this->compare->getMin($this->betweenDateGreater));
        $this->assertEquals($this->compareDate, $this->compare->getMin($this->compareDate));
    }

    public function testGetMaximumDate()
    {
        $this->assertEquals($this->betweenDateGreater, $this->compare->getMax($this->betweenDateGreater));
        $this->assertEquals($this->compareDate, $this->compare->getMax($this->betweenDateLower));
        $this->assertEquals($this->compareDate, $this->compare->getMax($this->compareDate));
    }
}
