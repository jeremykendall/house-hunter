<?php

namespace HH\Tests\Calculator;

use HH\Calculator\CriteriaCalculator;
use HH\Document\Criterion;

class CriteriaCalculatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array[Criterion]
     */
    private $criteria;

    /**
     * @var CriteriaCalculator
     */
    private $calculator;

    protected function setUp()
    {
        parent::setUp();
        
        // Has fence
        $criterion = new Criterion('fence', 5, 1, 1);
        $criterion->setValue(1);
        $this->criteria['fence'] = $criterion;

        // Has garage
        $criterion = new Criterion('garage', 3, 1, 1);
        $criterion->setValue(1);
        $this->criteria['garage'] = $criterion;

        // Rent = $1000
        $criterion = new Criterion('rent', 5, 1300, 700);
        $criterion->setValue(1000);
        $this->criteria['rent'] = $criterion;

        // Four bedrooms
        $criterion = new Criterion('rooms', 5, 3, 3);
        $criterion->setValue(4);
        $this->criteria['rooms'] = $criterion;

        // No central air
        $criterion = new Criterion('central air', 4, 1, 1);
        $criterion->setValue(0);
        $this->criteria['central air'] = $criterion;

        $this->calculator = new CriteriaCalculator();
    }

    public function testCalculateScore()
    {
        $this->assertEquals(70.45, $this->calculator->calculateScore($this->criteria));
    }

    public function testCalculateScoreNoGarageHasCentralAirThreeRooms()
    {
        $this->criteria['garage']->setValue(0);
        $this->criteria['rooms']->setValue(3);
        $this->criteria['central air']->setValue(1);

        $this->assertEquals(75, $this->calculator->calculateScore($this->criteria));
    }

    public function testCalculateScoreRentTooHigh()
    {
        $this->criteria['rent']->setValue(1350);

        $this->assertEquals(57.20, $this->calculator->calculateScore($this->criteria));
    }
}
