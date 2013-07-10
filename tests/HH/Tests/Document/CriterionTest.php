<?php

namespace HH\Tests\Document;

use HH\Document\Criterion;

class CriterionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider criteriaScoreDataProvider
     */
    public function testGetCriteriaScore($weight, $lowest, $highest, $value, $score)
    {
        $criterion = new Criterion('test', $weight, $lowest, $highest);
        $criterion->setValue($value);
        $this->assertEquals($score, $criterion->getScore());
    }

    public function criteriaScoreDataProvider()
    {
        return array(
            // High-ish rent
            array(5, 1500, 500, 1100, 200),
            // Low rent
            array(5, 1500, 500, 600, 450),
            // Has dishwasher
            array(4, 1, 1, 1, 400),
            // Has not garbage disposal
            array(2, 1, 1, 0, 0),
        );
    }

    /**
     * @dataProvider normalizeValueDataProvider
     */
    public function testNormalizeValue($lowest, $highest, $value, $converted)
    {
        $criterion = new Criterion('test', 5, $lowest, $highest);
        $criterion->setValue($value);
        $this->assertEquals($converted, $criterion->normalizeValue());
    }

    public function normalizeValueDataProvider()
    {
        return array(
            array(5, 30, 10, 20),
            array(5, 30, 15, 40),
            array(5, 30, 20, 60),
            array(1500, 500, 600, 90),
            array(1500, 500, 1400, 10),
            array(1500, 500, 975, 52.50),
            array(1500, 500, 750, 75.00),
        );
    }
}
