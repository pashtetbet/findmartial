<?php
// src/Acme/FindMartialBundle/Entity/User.php

namespace Acme\FindMartialBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_user")
 */
class User extends BaseUser
{

    /**
     * @ORM\OneToOne(targetEntity="Client", inversedBy="user")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    protected $client;
    
    
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
     * @ORM\Column(type="string", length=100)
     */
		protected $family;
		
		/**
     * @ORM\Column(type="decimal", scale=2, nullable = true)
     */
		protected $estimateValue;
		
		/**
     * @ORM\Column(type="smallint", nullable = true)
     */
		protected $estimateCount;
		
		/**
     * @ORM\Column(type="smallint", nullable = true)
     */
		protected $commentsNumber;
		
		/**
     * @ORM\Column(type="text", nullable = true)
     */
		protected $about;
		
    /**
     * @ORM\Column(type="string", length=150, nullable = true)
     */
		protected $avatar;
		
		/**
     * @ORM\Column(type="boolean")
     */
		protected $authorisedComments = 0;

    public function __construct()
    {
        parent::__construct();
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
     * @return User
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
     * @return User
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
     * Set estimateValue
     *
     * @param float $estimateValue
     * @return User
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
     * Set estimateCount
     *
     * @param integer $estimateCount
     * @return User
     */
    public function setEstimateCount($estimateCount)
    {
        $this->estimateCount = $estimateCount;
    
        return $this;
    }

    /**
     * Get estimateCount
     *
     * @return integer 
     */
    public function getEstimateCount()
    {
        return $this->estimateCount;
    }

    /**
     * Set commentsNumber
     *
     * @param integer $commentsNumber
     * @return User
     */
    public function setCommentsNumber($commentsNumber)
    {
        $this->commentsNumber = $commentsNumber;
    
        return $this;
    }

    /**
     * Get commentsNumber
     *
     * @return integer 
     */
    public function getCommentsNumber()
    {
        return $this->commentsNumber;
    }

    /**
     * Set about
     *
     * @param string $about
     * @return User
     */
    public function setAbout($about)
    {
        $this->about = $about;
    
        return $this;
    }

    /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        return $this->about;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set authorisedComments
     *
     * @param boolean $authorisedComments
     * @return User
     */
    public function setAuthorisedComments($authorisedComments)
    {
        $this->authorisedComments = $authorisedComments;
    
        return $this;
    }

    /**
     * Get authorisedComments
     *
     * @return boolean 
     */
    public function getAuthorisedComments()
    {
        return $this->authorisedComments;
    }

    /**
     * Set client
     *
     * @param \Acme\FindMartialBundle\Entity\Client $client
     * @return User
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
}