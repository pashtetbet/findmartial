<?php
// src/Acme/FindMartialBundle/Entity/Client.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_client")
 */
class Client
{

    /**
     * @ORM\OneToOne(targetEntity="User", mappedBy="client")
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="Master", inversedBy="client")
     * @ORM\JoinColumn(name="master_id", referencedColumnName="id")
     */
    protected $master;

    /**
     * @ORM\ManyToMany(targetEntity="MasterClient", mappedBy="client")
     **/
    protected $masters;

    /**
     * @ORM\OneToMany(targetEntity="Club", mappedBy="client")
     **/
    private $clubs;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="check")
     **/
    private $duplicates;

    /**
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="duplicates")
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
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", unique=true, length=100, nullable = true)
     */
    protected $inn;

    /**
    * @ORM\Column(type="string", length=100, nullable = true)
    */
    protected $website;

    /**
    * @ORM\Column(type="string", length=150, nullable = true)
    */
    protected $mail;

    /**
    * @ORM\Column(type="string", length=100, nullable = true)
    */
    protected $phone;

    //перечисления
    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('active', 'notactive')", nullable = true)
    */
    protected $status;

    /**
    * @ORM\Column(type="decimal", scale=2)
    */
    protected $money = 0;

    //перечисления
    /**
    * @ORM\Column(type="string", columnDefinition="ENUM('social', 'municipal')", nullable = true)
    */
    protected $social;

    /**
    * @ORM\Column(type="string", length=150, nullable = true)
    */
    protected $logo;

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
    protected $news_on = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $is_checked = false;

    public function __construct()
    {
        $this->masters = new \Doctrine\Common\Collections\ArrayCollection();
        $this->clubs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Client
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
     * Set inn
     *
     * @param string $inn
     * @return Client
     */
    public function setInn($inn)
    {
        $this->inn = $inn;
    
        return $this;
    }

    /**
     * Get inn
     *
     * @return string 
     */
    public function getInn()
    {
        return $this->inn;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Client
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Client
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
     * @return Client
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
     * Set status
     *
     * @param string $status
     * @return Client
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set money
     *
     * @param float $money
     * @return Client
     */
    public function setMoney($money)
    {
        $this->money = $money;
    
        return $this;
    }

    /**
     * Get money
     *
     * @return float 
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * Set social
     *
     * @param string $social
     * @return Client
     */
    public function setSocial($social)
    {
        $this->social = $social;
    
        return $this;
    }

    /**
     * Get social
     *
     * @return string 
     */
    public function getSocial()
    {
        return $this->social;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Client
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set estimate_value
     *
     * @param float $estimateValue
     * @return Client
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
     * @return Client
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
     * Set news_on
     *
     * @param boolean $newsOn
     * @return Client
     */
    public function setNewsOn($newsOn)
    {
        $this->news_on = $newsOn;
    
        return $this;
    }

    /**
     * Get news_on
     *
     * @return boolean 
     */
    public function getNewsOn()
    {
        return $this->news_on;
    }

    /**
     * Set is_checked
     *
     * @param boolean $isChecked
     * @return Client
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
     * Set user
     *
     * @param \Acme\FindMartialBundle\Entity\User $user
     * @return Client
     */
    public function setUser(\Acme\FindMartialBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Acme\FindMartialBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set master
     *
     * @param \Acme\FindMartialBundle\Entity\Master $master
     * @return Client
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
     * Add masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterClient $masters
     * @return Client
     */
    public function addMaster(\Acme\FindMartialBundle\Entity\MasterClient $masters)
    {
        $this->masters[] = $masters;
    
        return $this;
    }

    /**
     * Remove masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterClient $masters
     */
    public function removeMaster(\Acme\FindMartialBundle\Entity\MasterClient $masters)
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
     * Add clubs
     *
     * @param \Acme\FindMartialBundle\Entity\Club $clubs
     * @return Client
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
     * Add duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Client $duplicates
     * @return Client
     */
    public function addDuplicate(\Acme\FindMartialBundle\Entity\Client $duplicates)
    {
        $this->duplicates[] = $duplicates;
    
        return $this;
    }

    /**
     * Remove duplicates
     *
     * @param \Acme\FindMartialBundle\Entity\Client $duplicates
     */
    public function removeDuplicate(\Acme\FindMartialBundle\Entity\Client $duplicates)
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
     * @param \Acme\FindMartialBundle\Entity\Client $check
     * @return Client
     */
    public function setCheck(\Acme\FindMartialBundle\Entity\Client $check = null)
    {
        $this->check = $check;
    
        return $this;
    }

    /**
     * Get check
     *
     * @return \Acme\FindMartialBundle\Entity\Client 
     */
    public function getCheck()
    {
        return $this->check;
    }
}