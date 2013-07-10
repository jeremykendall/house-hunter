<?php

namespace HH\Calculator;

class CriteriaCalculator
{
    /**
     * Calculates total criteria score
     *
     * @param  array[Criterion] $criteria Critera to score
     * @return float            Total score
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
