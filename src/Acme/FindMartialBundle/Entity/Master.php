<?php
// src/Acme/FindMartialBundle/Entity/Master.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_master")
 */
class Master
{

    /**
     * @ORM\OneToOne(targetEntity="Client", mappedBy="master")
     */
    protected $client;

    /**
     * @ORM\OneToMany(targetEntity="MasterArt", mappedBy="master", cascade={"persist", "remove"})
     **/
    protected $masterArts;

    /**
     * @ORM\ManyToMany(targetEntity="Club", mappedBy="masters", cascade={"persist", "remove"})
     **/
    protected $clubs;

    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="master")
     **/
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity="Master", mappedBy="check")
     **/
    private $duplicates;

    /**
     * @ORM\ManyToOne(targetEntity="Master", inversedBy="duplicates")
     * @ORM\JoinColumn(name="check_id", referencedColumnName="id")
     **/
    private $check;
  
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint", nullable=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Acme\FindMartialBundle\Extension\IdGenerator")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $family;

    /**
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $patronym;

    /**
    * @ORM\Column(type="string", length=255, nullable = true)
    */
    protected $hightlights;

    /**
    * @ORM\Column(type="string", length=255, nullable = true)
    */
    protected $description;
    	
    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('male', 'female')", nullable = true)
    */
    protected $sex;

    /**
    * @var \Date
    */
    protected $birth;

    /**
    * @ORM\Column(type="string", length=150, nullable = true)
    */
    protected $photo;

    /**
     * @ORM\Column(type="boolean", nullable = true)
    */
    protected $slave;

    /**
    * @ORM\Column(type="decimal", scale=2)
    */
    protected $estimate_value = 0;

    /**
    * @ORM\Column(type="smallint")
    */
    protected $estimate_number = 0;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $visible = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $is_checked = false;

    /**
    * @ORM\Column(type="integer", nullable = true)
    */
    protected $experience_full;

    /**
    * @ORM\Column(type="integer", nullable = true)
    */
    protected $training_exp_full;

    public function __construct()
    {
        $this->clients        = new \Doctrine\Common\Collections\ArrayCollection();
        $this->masterArts     = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clubs          = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trainings      = new \Doctrine\Common\Collections\ArrayCollection();
        $this->duplicates     = new \Doctrine\Common\Collections\ArrayCollection();
    }

    function __toString()
    {
        return (string)$this->getName();
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
     * @return Master
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
     * Set family
     *
     * @param string $family
     * @return Master
     */
    public function setFamily($family)
    {
        $this->family = $family;
    
        return $this;
    }

    /**
     * Get family
     *
     * @return string 
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * Set patronym
     *
     * @param string $patronym
     * @return Master
     */
    public function setPatronym($patronym)
    {
        $this->patronym = $patronym;
    
        return $this;
    }

    /**
     * Get patronym
     *
     * @return string 
     */
    public function getPatronym()
    {
        return $this->patronym;
    }

    /**
     * Set hightlights
     *
     * @param string $hightlights
     * @return Master
     */
    public function setHightlights($hightlights)
    {
        $this->hightlights = $hightlights;
    
        return $this;
    }

    /**
     * Get hightlights
     *
     * @return string 
     */
    public function getHightlights()
    {
        return $this->hightlights;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Master
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Master
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Master
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set slave
     *
     * @param boolean $slave
     * @return Master
     */
    public function setSlave($slave)
    {
        $this->slave = $slave;
    
        return $this;
    }

    /**
     * Get slave
     *
     * @return boolean 
     */
    public function getSlave()
    {
        return $this->slave;
    }

    /**
     * Set estimate_value
     *
     * @param float $estimateValue
     * @return Master
     */
    public function setEstimateValue($estimateValue)
    {
        $this->estimate_value = $estimateValue;
    
        return $this;
    }

    /**
     * Get estimate_value
     *
     * @return float 
     */
    public function getEstimateValue()
    {
        return $this->estimate_value;
    }

    /**
     * Set estimate_number
     *
     * @param integer $estimateNumber
     * @return Master
     */
    public function setEstimateNumber($estimateNumber)
    {
        $this->estimate_number = $estimateNumber;
    
        return $this;
    }

    /**
     * Get estimate_number
     *
     * @return integer 
     */
    public function getEstimateNumber()
    {
        return $this->estimate_number;
    }

    /**
     * Set visible
     *
     * @param boolean $visible
     * @return Master
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
     * Set is_checked
     *
     * @param boolean $isChecked
     * @return Master
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
     * Set experience_full
     *
     * @param integer $experienceFull
     * @return Master
     */
    public function setExperienceFull($experienceFull)
    {
        $this->experience_full = $experienceFull;
    
        return $this;
    }

    /**
     * Get experience_full
     *
     * @return integer 
     */
    public function getExperienceFull()
    {
        return $this->experience_full;
    }

    /**
     * Set training_exp_full
     *
     * @param integer $trainingExpFull
     * @return Master
     */
    public function setTrainingExpFull($trainingExpFull)
    {
        $this->training_exp_full = $trainingExpFull;
    
        return $this;
    }

    /**
     * Get training_exp_full
     *
     * @return integer 
     */
    public function getTrainingExpFull()
    {
        return $this->training_exp_full;
    }

    /**
     * Set client
     *
     * @param \Acme\FindMartialBundle\Entity\Client $client
     * @return Master
     */
    public function setClient(\Acme\FindMartialBundle\Entity\Client $client = null)
    {
        $this->client = $client;
    
        return $this;
    }

    /**
     * Get client
     *
     * @return \Acme\FindMartialBundle\Entity\Client 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Add masterArts
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masterArts
     * @return Master
     */
    public function addMasterArt(\Acme\FindMartialBundle\Entity\MasterArt $masterArts)
    {
        //pashtet **for embed forms robust
        $masterArts->setMaster($this);

        $this->masterArts[] = $masterArts;
    
        return $this;
    }

    /**
     * Remove masterArts
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masterArts
     */
    public function removeMasterArt(\Acme\FindMartialBundle\Entity\MasterArt $masterArts)
    {
        $this->masterArts->removeElement($masterArts);
    }

    /**
     * Get masterArts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMasterArts()
    {
        return $this->masterArts;
    }

    /**
     * Add clubs
     *
     * @param \Acme\FindMartialBundle\Entity\Club $clubs
     * @return Master
     */
    public function addClub(\Acme\FindMartialBundle\Entity\Club $clubs)
    {
        $this->clubs[] = $clubs;
    
        return $this;
    }

    /**
     * Remove clubs
     *
     * @param \Acme\FindMartialBundle\Entity\Club $clubs
     */
    public function removeClub(\Acme\FindMartialBundle\Entity\Club $clubs)
    {
        $this->clubs->removeElement($clubs);
    }

    /**
     * Get clubs
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClubs()
    {
        return $this->clubs;
    }

    /**
     * Add trainings
     *
     * @param \Acme\FindMartialBundle\Entity\Training $trainings
     * @return Master
     */
    public function addTraining(\Acme\FindMartialBundle\Entity\Training $trainings)
    {
        $this->trainings[] = $trainings;
    
        return $this;
    }

    /**
     * Remove trainings
     *
     * @param \Acme\FindMartialBundle\Entity\Training $trainings
     */
    public function removeTraining(\Acme\FindMartialBundle\Entity\Training $trainings)
    {
        $this->trainings->removeElement($trainings);
    }

    /**
     * Get trainings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTrainings()
    {
        return $this->trainings;
    }

    /**
     * Add duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Master $duplicates
     * @return Master
     */
    public function addDuplicate(\Acme\FindMartialBundle\Entity\Master $duplicates)
    {
        $this->duplicates[] = $duplicates;
    
        return $this;
    }

    /**
     * Remove duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Master $duplicates
     */
    public function removeDuplicate(\Acme\FindMartialBundle\Entity\Master $duplicates)
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
     * @param \Acme\FindMartialBundle\Entity\Master $check
     * @return Master
     */
    public function setCheck(\Acme\FindMartialBundle\Entity\Master $check = null)
    {
        $this->check = $check;
    
        return $this;
    }

    /**
     * Get check
     *
     * @return \Acme\FindMartialBundle\Entity\Master 
     */
    public function getCheck()
    {
        return $this->check;
    }
}