<?php
// src/Acme/FindMartialBundle/Entity/Club.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_club")
 */
class Club
{

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="clubs")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     */
    protected $city;

    /**
     * @ORM\ManyToMany(targetEntity="AddServ", inversedBy="clubs")
     * @ORM\JoinTable(name="fm_club_servise")
     **/
    protected $servises;

    /**
     * @ORM\OneToMany(targetEntity="MasterClub", mappedBy="club")
     **/
    protected $masters;

    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="club")
     **/
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity="ClubType", mappedBy="club")
     **/
    private $types;

    /**
     * @ORM\OneToMany(targetEntity="ClubLevel", mappedBy="club")
     **/
    private $levels;

    /**
     * @ORM\OneToMany(targetEntity="ClubArt", mappedBy="club")
     **/
    private $arts;

    /**
     * @ORM\OneToMany(targetEntity="Club", mappedBy="check")
     **/
    private $duplicates;

    /**
     * @ORM\ManyToOne(targetEntity="Club", inversedBy="duplicates")
     * @ORM\JoinColumn(name="check_id", referencedColumnName="id")
     **/
    private $check;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    protected $description;

    /**
    * @ORM\Column(type="string", length=255, nullable = true)
    */
    protected $address;

    /**
    * @ORM\Column(type="string", length=255, nullable = true)
    */
    protected $address_comment;

    /**
    * @ORM\Column(type="decimal", precision=10, scale=7, nullable = true)
    */
    protected $latitude;

    /**
    * @ORM\Column(type="decimal", precision=10, scale=7, nullable = true)
    */
    protected $longitude;

    /**
    * @ORM\Column(type="string", length=150, nullable = true)
    */
    protected $mail;

    /**
    * @ORM\Column(type="string", length=100, nullable = true)
    */
    protected $phone;

    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $indic_price_min;

    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $indic_price_max;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('adults', 'children', 'common')", nullable = true)
    */
    protected $age_type;

    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('male', 'female')", nullable = true)
    */
    protected $sex;

    /**
    * @ORM\Column(type="decimal", scale=2)
    */
    protected $estimate_value = 0;

    /**
    * @ORM\Column(type="smallint")
    */
    protected $estimate_number = 0;

    /**
    * @ORM\Column(type="boolean", nullable = true)
    */
    protected $one_training_free;

    /**
    * @ORM\Column(type="string", length=150, nullable = true)
    */
    protected $photo; 

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
        $this->servises = new \Doctrine\Common\Collections\ArrayCollection();
        $this->masters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->trainings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->types = new \Doctrine\Common\Collections\ArrayCollection();
        $this->levels = new \Doctrine\Common\Collections\ArrayCollection();
        $this->arts = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return Club
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
     * Set address
     *
     * @param string $address
     * @return Club
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address_comment
     *
     * @param string $addressComment
     * @return Club
     */
    public function setAddressComment($addressComment)
    {
        $this->address_comment = $addressComment;

        return $this;
    }

    /**
     * Get address_comment
     *
     * @return string 
     */
    public function getAddressComment()
    {
        return $this->address_comment;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return Club
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return Club
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Club
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Club
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set indic_price_min
     *
     * @param float $indicPriceMin
     * @return Club
     */
    public function setIndicPriceMin($indicPriceMin)
    {
        $this->indic_price_min = $indicPriceMin;

        return $this;
    }

    /**
     * Get indic_price_min
     *
     * @return float 
     */
    public function getIndicPriceMin()
    {
        return $this->indic_price_min;
    }

    /**
     * Set indic_price_max
     *
     * @param float $indicPriceMax
     * @return Club
     */
    public function setIndicPriceMax($indicPriceMax)
    {
        $this->indic_price_max = $indicPriceMax;

        return $this;
    }

    /**
     * Get indic_price_max
     *
     * @return float 
     */
    public function getIndicPriceMax()
    {
        return $this->indic_price_max;
    }

    /**
     * Set age_type
     *
     * @param string $ageType
     * @return Club
     */
    public function setAgeType($ageType)
    {
        $this->age_type = $ageType;

        return $this;
    }

    /**
     * Get age_type
     *
     * @return string 
     */
    public function getAgeType()
    {
        return $this->age_type;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Club
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
     * Set estimate_value
     *
     * @param float $estimateValue
     * @return Club
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
     * @return Club
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
     * Set one_training_free
     *
     * @param boolean $oneTrainingFree
     * @return Club
     */
    public function setOneTrainingFree($oneTrainingFree)
    {
        $this->one_training_free = $oneTrainingFree;

        return $this;
    }

    /**
     * Get one_training_free
     *
     * @return boolean 
     */
    public function getOneTrainingFree()
    {
        return $this->one_training_free;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return Club
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
     * Set is_checked
     *
     * @param boolean $isChecked
     * @return Club
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
     * @return Club
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
     * Set client
     *
     * @param \Acme\FindMartialBundle\Entity\Client $client
     * @return Club
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
     * Set city
     *
     * @param \Acme\FindMartialBundle\Entity\City $city
     * @return Club
     */
    public function setCity(\Acme\FindMartialBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \Acme\FindMartialBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Add servises
     *
     * @param \Acme\FindMartialBundle\Entity\AddServ $servises
     * @return Club
     */
    public function addServise(\Acme\FindMartialBundle\Entity\AddServ $servises)
    {
        $this->servises[] = $servises;

        return $this;
    }

    /**
     * Remove servises
     *
     * @param \Acme\FindMartialBundle\Entity\AddServ $servises
     */
    public function removeServise(\Acme\FindMartialBundle\Entity\AddServ $servises)
    {
        $this->servises->removeElement($servises);
    }

    /**
     * Get servises
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServises()
    {
        return $this->servises;
    }

    /**
     * Add masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterClub $masters
     * @return Club
     */
    public function addMaster(\Acme\FindMartialBundle\Entity\MasterClub $masters)
    {
        $this->masters[] = $masters;

        return $this;
    }

    /**
     * Remove masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterClub $masters
     */
    public function removeMaster(\Acme\FindMartialBundle\Entity\MasterClub $masters)
    {
        $this->masters->removeElement($masters);
    }

    /**
     * Get masters
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMasters()
    {
        return $this->masters;
    }

    /**
     * Add trainings
     *
     * @param \Acme\FindMartialBundle\Entity\Training $trainings
     * @return Club
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
     * Add types
     *
     * @param \Acme\FindMartialBundle\Entity\ClubType $types
     * @return Club
     */
    public function addType(\Acme\FindMartialBundle\Entity\ClubType $types)
    {
        $this->types[] = $types;

        return $this;
    }

    /**
     * Remove types
     *
     * @param \Acme\FindMartialBundle\Entity\ClubType $types
     */
    public function removeType(\Acme\FindMartialBundle\Entity\ClubType $types)
    {
        $this->types->removeElement($types);
    }

    /**
     * Get types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Add levels
     *
     * @param \Acme\FindMartialBundle\Entity\ClubLevel $levels
     * @return Club
     */
    public function addLevel(\Acme\FindMartialBundle\Entity\ClubLevel $levels)
    {
        $this->levels[] = $levels;

        return $this;
    }

    /**
     * Remove levels
     *
     * @param \Acme\FindMartialBundle\Entity\ClubLevel $levels
     */
    public function removeLevel(\Acme\FindMartialBundle\Entity\ClubLevel $levels)
    {
        $this->levels->removeElement($levels);
    }

    /**
     * Get levels
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Add arts
     *
     * @param \Acme\FindMartialBundle\Entity\ClubArt $arts
     * @return Club
     */
    public function addArt(\Acme\FindMartialBundle\Entity\ClubArt $arts)
    {
        $this->arts[] = $arts;

        return $this;
    }

    /**
     * Remove arts
     *
     * @param \Acme\FindMartialBundle\Entity\ClubArt $arts
     */
    public function removeArt(\Acme\FindMartialBundle\Entity\ClubArt $arts)
    {
        $this->arts->removeElement($arts);
    }

    /**
     * Get arts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArts()
    {
        return $this->arts;
    }

    /**
     * Add duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Club $duplicates
     * @return Club
     */
    public function addDuplicate(\Acme\FindMartialBundle\Entity\Club $duplicates)
    {
        $this->duplicates[] = $duplicates;

        return $this;
    }

    /**
     * Remove duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Club $duplicates
     */
    public function removeDuplicate(\Acme\FindMartialBundle\Entity\Club $duplicates)
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
     * @param \Acme\FindMartialBundle\Entity\Club $check
     * @return Club
     */
    public function setCheck(\Acme\FindMartialBundle\Entity\Club $check = null)
    {
        $this->check = $check;

        return $this;
    }

    /**
     * Get check
     *
     * @return \Acme\FindMartialBundle\Entity\Club 
     */
    public function getCheck()
    {
        return $this->check;
    }
}
