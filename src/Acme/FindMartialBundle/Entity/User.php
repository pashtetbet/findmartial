<?php
// src/Acme/FindMartialBundle/Entity/User.php

namespace Acme\FindMartialBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_user")
 * @FileStore\Uploadable
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
     * @ORM\Column(type="string", length=100, nullable = true)
     */
    protected $family;

    /**
    * @ORM\Column(type="decimal", scale=2, nullable = true)
    */
    protected $estimate_value;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    protected $estimate_count;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    protected $comments_number;

    /**
    * @ORM\Column(type="text", nullable = true)
    */
    protected $about;

    /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $date;

    /**
     * @Assert\File( maxSize="20M")
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array", nullable = true)
     */
    private $avatar = null;


    /**
    * @ORM\Column(type="boolean")
    */
    protected $authorised_comments = 0;

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
     * Set estimate_value
     *
     * @param float $estimateValue
     * @return User
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
     * Set estimate_count
     *
     * @param integer $estimateCount
     * @return User
     */
    public function setEstimateCount($estimateCount)
    {
        $this->estimate_count = $estimateCount;

        return $this;
    }

    /**
     * Get estimate_count
     *
     * @return integer 
     */
    public function getEstimateCount()
    {
        return $this->estimate_count;
    }

    /**
     * Set comments_number
     *
     * @param integer $commentsNumber
     * @return User
     */
    public function setCommentsNumber($commentsNumber)
    {
        $this->comments_number = $commentsNumber;

        return $this;
    }

    /**
     * Get comments_number
     *
     * @return integer 
     */
    public function getCommentsNumber()
    {
        return $this->comments_number;
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
     * Set authorised_comments
     *
     * @param boolean $authorisedComments
     * @return User
     */
    public function setAuthorisedComments($authorisedComments)
    {
        $this->authorised_comments = $authorisedComments;

        return $this;
    }

    /**
     * Get authorised_comments
     *
     * @return boolean 
     */
    public function getAuthorisedComments()
    {
        return $this->authorised_comments;
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

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return User
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set avatar
     *
     * @param array $avatar
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
     * @return array 
     */
    public function getAvatar()
    {
        return $this->avatar;
    }
}