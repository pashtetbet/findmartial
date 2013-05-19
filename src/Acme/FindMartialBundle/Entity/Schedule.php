<?php
// src/Acme/FindMartialBundle/Entity/Schedule.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_schedule")
 */
class Schedule
{

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="schedules")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    protected $training;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('mon', 'tue', 'wen', 'thr', 'fri', 'sat', 'sun')", nullable = true)
    */
    protected $weekday;

    /**
    * @ORM\Column(name="start_time", type="time", nullable = true)
    */
    protected $start_time;

    /**
    * @var \Time
    */
    protected $end_time;

    public function __construct()
    {
		//$this->masters     = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set weekday
     *
     * @param string $weekday
     * @return Schedule
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;
    
        return $this;
    }

    /**
     * Get weekday
     *
     * @return string 
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Set start_time
     *
     * @param \DateTime $startTime
     * @return Schedule
     */
    public function setStartTime($startTime)
    {
        $this->start_time = $startTime;
    
        return $this;
    }

    /**
     * Get start_time
     *
     * @return \DateTime 
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Set training
     *
     * @param \Acme\FindMartialBundle\Entity\Training $training
     * @return Schedule
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
