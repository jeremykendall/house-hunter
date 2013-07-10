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

    /**
     * DO NOT PERSIST
     * @var float value
     */
    private $value;

    /**
     * @var float lowest value
     * @ODM\Float
     */
    private $lowest;

    /**
     * @var float highest value
     * @ODM\Float
     */
    private $highest;

    /**
     * @var int Criterion weight
     * @ODM\Int
     */
    private $weight;

    /**
     * Public constructor
     *
     * @param string $name    Name
     * @param int    $weight  Weight applied to criterion
     * @param float  $lowest  Lowest desired value
     * @param float  $highest Highest desired value
     */
    public function __construct($name, $weight, $lowest, $highest)
    {
        $this->name = $name;
        $this->weight = $weight;
        $this->lowest = $lowest;
        $this->highest = $highest;
    }

    /**
     * Calculates and returns criterion score
     *
     * @return float Criterion score
     */
    public function getScore()
    {
        return ($this->normalizeValue($this->value) * $this->weight);
    }

    /**
     * Converts value to number between 0 and 100
     *
     * @return float Normalized criterion value
     */
    public function normalizeValue()
    {
        if ($this->lowest === $this->highest && $this->value >= $this->highest) {
            return 100;
        }

        if ($this->lowest === $this->highest && $this->value < $this->highest) {
            return 0;
        }

        $percent = ($this->value - $this->lowest) / ($this->highest - $this->lowest);

        return number_format($percent * 100, 2);
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
