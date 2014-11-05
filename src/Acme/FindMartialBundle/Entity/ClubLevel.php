<?php
// src/Acme/FindMartialBundle/Entity/ClubLevel.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_club_level")
 */
class ClubLevel
{

    /**
     * @ORM\ManyToOne(targetEntity="club", inversedBy="levels")
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
    * @ORM\Column(type="string", columnDefinition="ENUM('noob', 'beginner', 'hardcore', 'nightmare')", nullable = true)
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
     * Set value
     *
     * @param string $value
     * @return ClubLevel
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set club
     *
     * @param \Acme\FindMartialBundle\Entity\club $club
     * @return ClubLevel
     */
    public function setClub(\Acme\FindMartialBundle\Entity\club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
     * Get club
     *
     * @return \Acme\FindMartialBundle\Entity\club 
     */
    public function getClub()
    {
        return $this->club;
    }
}