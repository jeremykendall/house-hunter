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
     * @var int Criterion weight
     * @ODM\String
     */
    private $weight;

    public function __construct($name, $weight)
    {
        $this->name = $name;
        $this->weight = $weight;
    }
    
    /**
     * Get id
     *
     * @return int id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set id
     *
     * @param int $id the value to set
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get name
     *
     * @return string name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set name
     *
     * @param string $name the value to set
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Get weight
     *
     * @return int weight
     */
    public function getWeight()
    {
        return $this->weight;
    }
    
    /**
     * Set weight
     *
     * @param int $weight the value to set
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }
}
