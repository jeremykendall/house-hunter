<?php

namespace HH\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document(collection="criteria")
 * @ODM\Indexes({
 *     @ODM\Index(keys={"name"="desc"}, options={"unique"=true})
 * })
 */
class Criterion
{
    /**
     * @var int Id
     * @ODM\Id
     */
    private $id;

    /**
     * @var string Criterion name
     * @ODM\String
     */
    private $name;

    private $lowUpperBound;
    private $highLowerBound;
    private $value;
    private $lowest;
    private $highest;

    /**
     * @var int Criterion weight
     * @ODM\String
     */
    private $weight;

    public function __construct($name, $weight, $highLowerBound, $lowUpperBound)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->highLowerBound = $highLowerBound;
        $this->lowUpperBound = $lowUpperBound;
    }

    public function getScore()
    {
        return ($this->value * $this->weight) * $this->getRangeMultiplier();
    }

    public function getRangeMultiplier()
    {
        $max = $this->lowUpperBound;
        $min = $this->highLowerBound;

        if ($min == $max) {
            if ($this->value >= $max) {
                return 2;
            }

            return 0;
        }

        if ($min > $max) {
            if ($this->value <= $max) {
                return 2;
            }

            if ($this->value > $min) {
                return 0;
            }

            return 1;
        }

        if ($this->value >= $max) {
            return 2;
        }

        if ($this->value < $min) {
            return 0;
        }

        return 1;
    }

    /**
     * Get id
     *
     * @return id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param $id the value to set
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get name
     *
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param $name the value to set
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get lowUpperBound
     *
     * @return lowUpperBound
     */
    public function getLowUpperBound()
    {
        return $this->lowUpperBound;
    }

    /**
     * Set lowUpperBound
     *
     * @param $lowUpperBound the value to set
     */
    public function setLowUpperBound($lowUpperBound)
    {
        $this->lowUpperBound = $lowUpperBound;
    }

    /**
     * Get highLowerBound
     *
     * @return highLowerBound
     */
    public function getHighLowerBound()
    {
        return $this->highLowerBound;
    }

    /**
     * Set highLowerBound
     *
     * @param $highLowerBound the value to set
     */
    public function setHighLowerBound($highLowerBound)
    {
        $this->highLowerBound = $highLowerBound;
    }

    /**
     * Get value
     *
     * @return value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set value
     *
     * @param $value the value to set
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get weight
     *
     * @return weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set weight
     *
     * @param $weight the value to set
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
    
    /**
     * Get lowest
     *
     * @return lowest
     */
    public function getLowest()
    {
        return $this->lowest;
    }
    
    /**
     * Set lowest
     *
     * @param $lowest the value to set
     */
    public function setLowest($lowest)
    {
        $this->lowest = $lowest;
    }
    
    /**
     * Get highest
     *
     * @return highest
     */
    public function getHighest()
    {
        return $this->highest;
    }
    
    /**
     * Set highest
     *
     * @param $highest the value to set
     */
    public function setHighest($highest)
    {
        $this->highest = $highest;
    }
}
