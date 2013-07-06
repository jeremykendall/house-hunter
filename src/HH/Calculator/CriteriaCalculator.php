<?php

namespace HH\Calculator;

class CriteriaCalculator
{
    /**
     * @var array[Criterion]
     */
    private $criteria;

    /**
     * Calculates total criteria score
     *
     * @param array Critera to score
     * @return int Score
     */
    public function calculateScore(array $criteria)
    {
        $weightSum = 0;
        $scoreSum = 0;

        foreach ($criteria as $criterion) {
            $weightSum += $criterion->getWeight();
            $scoreSum += $criterion->getScore();
        }

        $score = $scoreSum / $weightSum; 

        return number_format($score, 2);
    }
}
