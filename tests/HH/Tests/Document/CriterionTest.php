<?php

namespace HH\Tests\Document;

use HH\Document\Criterion;

class CriterionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider criteriaScoreDataProvider
     */
    public function testGetCriteriaScore($weight, $highLower, $lowUpper, $value, $score)
    {
        $criterion = new Criterion('test', $weight, $highLower, $lowUpper);
        $criterion->setValue($value);
        $this->assertEquals($score, $criterion->getScore());
    }

    public function criteriaScoreDataProvider()
    {
        return array(
            // Mid-range rent
            array(5, 1200, 700, 1100, 5500),
            // Low rent
            array(5, 1200, 700, 699, 6990),
            // Has dishwasher
            array(4, 1, 1, 1, 8),
            // Has not garbage disposal
            array(2, 1, 1, 0, 0),
        );
    }

    /**
     * @dataProvider rangeMultiplierDataProvider
     */
    public function testGetRangeMultiplier($highLower, $lowUpper, $value, $multiplier)
    {
        $criterion = new Criterion('test', 5, $highLower, $lowUpper);
        $criterion->setValue($value);
        $this->assertEquals($multiplier, $criterion->getRangeMultiplier());
    }

    public function rangeMultiplierDataProvider()
    {
        return array(
            // Normal
            array(3, 7, 10, 2),
            array(3, 7, 4, 1),
            array(3, 7, 2, 0),
            // Inverted
            array(7, 3, 4, 1),
            array(7, 3, 1, 2),
            array(7, 3, 8, 0),
            // Same (boolean)
            array(3, 3, 7, 2),
            array(3, 3, 3, 2),
            array(3, 3, 2, 0),
        );
    }
}
