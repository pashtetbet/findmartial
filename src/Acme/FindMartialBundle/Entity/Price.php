<?php
// src/Acme/FindMartialBundle/Entity/Price.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_price")
 */
class Price
{

    /**
     * @ORM\OneToOne(targetEntity="Training", mappedBy="price")
     */
    protected $training;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $name;

    /**
    * @ORM\Column(type="boolean", nullable = true)
    */
    protected $is_typical;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('once', 'counter', 'timer')", nullable = true)
    */
    protected $type;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    protected $number_count;
    
    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $number_cost;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    protected $period_count;

    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $period_cost;

    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $value;

    public function __construct()
    {
		//
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Price
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set is_typical
     *
     * @param boolean $isTypical
     * @return Price
     */
    public function setIsTypical($isTypical)
    {
        $this->is_typical = $isTypical;

        return $this;
    }

    /**
     * Get is_typical
     *
     * @return boolean 
     */
    public function getIsTypical()
    {
        return $this->is_typical;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Price
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set number_count
     *
     * @param integer $numberCount
     * @return Price
     */
    public function setNumberCount($numberCount)
    {
        $this->number_count = $numberCount;

        return $this;
    }

    /**
     * Get number_count
     *
     * @return integer 
     */
    public function getNumberCount()
    {
        return $this->number_count;
    }

    /**
     * Set number_cost
     *
     * @param float $numberCost
     * @return Price
     */
    public function setNumberCost($numberCost)
    {
        $this->number_cost = $numberCost;

        return $this;
    }

    /**
     * Get number_cost
     *
     * @return float 
     */
    public function getNumberCost()
    {
        return $this->number_cost;
    }

    /**
     * Set period_count
     *
     * @param integer $periodCount
     * @return Price
     */
    public function setPeriodCount($periodCount)
    {
        $this->period_count = $periodCount;

        return $this;
    }

    /**
     * Get period_count
     *
     * @return integer 
     */
    public function getPeriodCount()
    {
        return $this->period_count;
    }

    /**
     * Set period_cost
     *
     * @param float $periodCost
     * @return Price
     */
    public function setPeriodCost($periodCost)
    {
        $this->period_cost = $periodCost;

        return $this;
    }

    /**
     * Get period_cost
     *
     * @return float 
     */
    public function getPeriodCost()
    {
        return $this->period_cost;
    }

    /**
     * Set value
     *
     * @param float $value
     * @return Price
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return float 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set training
     *
     * @param \Acme\FindMartialBundle\Entity\Training $training
     * @return Price
     */
    public function setTraining(\Acme\FindMartialBundle\Entity\Training $training = null)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get training
     *
     * @return \Acme\FindMartialBundle\Entity\Training 
     */
    public function getTraining()
    {
        return $this->training;
    }
}
