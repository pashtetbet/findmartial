<?php
// src/Acme/FindMartialBundle/Entity/Training.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_training")
 */
class Training
{

    /**
     * @ORM\OneToOne(targetEntity="Price", inversedBy="training")
     * @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     */
    protected $price;

    /**
     * @ORM\OneToMany(targetEntity="Schedule", mappedBy="training")
     **/
    protected $schedules;

    /**
     * @ORM\ManyToOne(targetEntity="Art")
     * @ORM\JoinColumn(name="art_id", referencedColumnName="id")
     **/
    private $art;

    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="check")
     **/
    private $duplicates;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="duplicates")
     * @ORM\JoinColumn(name="check_id", referencedColumnName="id")
     **/
    private $check;

    /**
     * @ORM\ManyToOne(targetEntity="Master", inversedBy="trainings")
     * @ORM\JoinColumn(name="master_id", referencedColumnName="id")
     **/
    protected $master;

    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="trainings")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     **/
    protected $club;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('self', 'group', 'minigroup', 'individ')", nullable = true)
    */
    protected $type;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    private $age_low;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    private $age_max;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $is_checked = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $visible = false;
    public function __construct()
    {
        $this->schedules     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->duplicates = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     * @return Training
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
     * Set age_low
     *
     * @param integer $ageLow
     * @return Training
     */
    public function setAgeLow($ageLow)
    {
        $this->age_low = $ageLow;
    
        return $this;
    }

    /**
     * Get age_low
     *
     * @return integer 
     */
    public function getAgeLow()
    {
        return $this->age_low;
    }

    /**
     * Set age_max
     *
     * @param integer $ageMax
     * @return Training
     */
    public function setAgeMax($ageMax)
    {
        $this->age_max = $ageMax;
    
        return $this;
    }

    /**
     * Get age_max
     *
     * @return integer 
     */
    public function getAgeMax()
    {
        return $this->age_max;
    }

    /**
     * Set is_checked
     *
     * @param boolean $isChecked
     * @return Training
     */
    public function setIsChecked($isChecked)
    {
        $this->is_checked = $isChecked;
    
        return $this;
    }

    /**
     * Get is_checked
     *
     * @return boolean 
     */
    public function getIsChecked()
    {
        return $this->is_checked;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Training
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    
        return $this;
    }

    /**
     * Get visible
     *
     * @return boolean 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set price
     *
     * @param \Acme\FindMartialBundle\Entity\Price $price
     * @return Training
     */
    public function setPrice(\Acme\FindMartialBundle\Entity\Price $price = null)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return \Acme\FindMartialBundle\Entity\Price 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add schedules
     *
     * @param \Acme\FindMartialBundle\Entity\Schedule $schedules
     * @return Training
     */
    public function addSchedule(\Acme\FindMartialBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;
    
        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \Acme\FindMartialBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\Acme\FindMartialBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Set art
     *
     * @param \Acme\FindMartialBundle\Entity\Art $art
     * @return Training
     */
    public function setArt(\Acme\FindMartialBundle\Entity\Art $art = null)
    {
        $this->art = $art;
    
        return $this;
    }

    /**
     * Get art
     *
     * @return \Acme\FindMartialBundle\Entity\Art 
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Add duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Training $duplicates
     * @return Training
     */
    public function addDuplicate(\Acme\FindMartialBundle\Entity\Training $duplicates)
    {
        $this->duplicates[] = $duplicates;
    
        return $this;
    }

    /**
     * Remove duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Training $duplicates
     */
    public function removeDuplicate(\Acme\FindMartialBundle\Entity\Training $duplicates)
    {
        $this->duplicates->removeElement($duplicates);
    }

    /**
     * Get duplicates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDuplicates()
    {
        return $this->duplicates;
    }

    /**
     * Set check
     *
     * @param \Acme\FindMartialBundle\Entity\Training $check
     * @return Training
     */
    public function setCheck(\Acme\FindMartialBundle\Entity\Training $check = null)
    {
        $this->check = $check;
    
        return $this;
    }

    /**
     * Get check
     *
     * @return \Acme\FindMartialBundle\Entity\Training 
     */
    public function getCheck()
    {
        return $this->check;
    }

    /**
     * Set master
     *
     * @param \Acme\FindMartialBundle\Entity\Master $master
     * @return Training
     */
    public function setMaster(\Acme\FindMartialBundle\Entity\Master $master = null)
    {
        $this->master = $master;
    
        return $this;
    }

    /**
     * Get master
     *
     * @return \Acme\FindMartialBundle\Entity\Master 
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * Set club
     *
     * @param \Acme\FindMartialBundle\Entity\Master $club
     * @return Training
     */
    public function setClub(\Acme\FindMartialBundle\Entity\Master $club = null)
    {
        $this->club = $club;
    
        return $this;
    }

    /**
     * Get club
     *
     * @return \Acme\FindMartialBundle\Entity\Master 
     */
    public function getClub()
    {
        return $this->club;
    }

    /**
     * Set master_club
     *
     * @param \Acme\FindMartialBundle\Entity\MasterClub $masterClub
     * @return Training
     */
    public function setMasterClub(\Acme\FindMartialBundle\Entity\MasterClub $masterClub = null)
    {
        $this->master_club = $masterClub;
    
        return $this;
    }

    /**
     * Get master_club
     *
     * @return \Acme\FindMartialBundle\Entity\MasterClub 
     */
    public function getMasterClub()
    {
        return $this->master_club;
    }
}
