<?php
// src/Acme/FindMartialBundle/Entity/Client.php

namespace Acme\FindMartialBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
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
     * @ORM\Column(type="boolean")
     */
		protected $isIndividual = false;
		//Individual_ID
		
		/**
     * @ORM\Column(type="string", length=150, nullable = true)
     */
		protected $logo;
		
		/**
     * @ORM\Column(type="decimal", scale=2)
     */
		protected $estimateValue = 0;
		
		/**
     * @ORM\Column(type="smallint")
     */
		protected $estimateNumber = 0;
		
		/**
     * @ORM\Column(type="boolean")
     */
		protected $newsOn = false;

		/**
     * @ORM\Column(type="boolean")
     */
		protected $isChecked = false;
		
		/**
     * @ORM\Column(type="integer", nullable = true)
     */
		protected $checkRef;

    public function __construct()
    {
        //parent::__construct();
        // your own logic
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
     * Set isIndividual
     *
     * @param boolean $isIndividual
     * @return Client
     */
    public function setIsIndividual($isIndividual)
    {
        $this->isIndividual = $isIndividual;
    
        return $this;
    }

    /**
     * Get isIndividual
     *
     * @return boolean 
     */
    public function getIsIndividual()
    {
        return $this->isIndividual;
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
     * Set estimateValue
     *
     * @param float $estimateValue
     * @return Client
     */
    public function setEstimateValue($estimateValue)
    {
        $this->estimateValue = $estimateValue;
    
        return $this;
    }

    /**
     * Get estimateValue
     *
     * @return float 
     */
    public function getEstimateValue()
    {
        return $this->estimateValue;
    }

    /**
     * Set estimateNumber
     *
     * @param integer $estimateNumber
     * @return Client
     */
    public function setEstimateNumber($estimateNumber)
    {
        $this->estimateNumber = $estimateNumber;
    
        return $this;
    }

    /**
     * Get estimateNumber
     *
     * @return integer 
     */
    public function getEstimateNumber()
    {
        return $this->estimateNumber;
    }

    /**
     * Set newsOn
     *
     * @param boolean $newsOn
     * @return Client
     */
    public function setNewsOn($newsOn)
    {
        $this->newsOn = $newsOn;
    
        return $this;
    }

    /**
     * Get newsOn
     *
     * @return boolean 
     */
    public function getNewsOn()
    {
        return $this->newsOn;
    }

    /**
     * Set isChecked
     *
     * @param boolean $isChecked
     * @return Client
     */
    public function setIsChecked($isChecked)
    {
        $this->isChecked = $isChecked;
    
        return $this;
    }

    /**
     * Get isChecked
     *
     * @return boolean 
     */
    public function getIsChecked()
    {
        return $this->isChecked;
    }

    /**
     * Set checkRef
     *
     * @param integer $checkRef
     * @return Client
     */
    public function setCheckRef($checkRef)
    {
        $this->checkRef = $checkRef;
    
        return $this;
    }

    /**
     * Get checkRef
     *
     * @return integer 
     */
    public function getCheckRef()
    {
        return $this->checkRef;
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
}