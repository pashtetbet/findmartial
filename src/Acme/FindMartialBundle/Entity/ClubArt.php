<?php
// src/Acme/FindMartialBundle/Entity/ClubArt.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_club_art")
 */
class ClubArt
{

    /**
     * @ORM\ManyToOne(targetEntity="club", inversedBy="arts")
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id")
     **/
    protected $club;

    /**
     * @ORM\ManyToOne(targetEntity="art")
     * @ORM\JoinColumn(name="art_id", referencedColumnName="id")
     **/
    protected $art;
  
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * Set club
     *
     * @param \Acme\FindMartialBundle\Entity\club $club
     * @return ClubArt
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

    /**
     * Set art
     *
     * @param \Acme\FindMartialBundle\Entity\art $art
     * @return ClubArt
     */
    public function setArt(\Acme\FindMartialBundle\Entity\art $art = null)
    {
        $this->art = $art;

        return $this;
    }

    /**
     * Get art
     *
     * @return \Acme\FindMartialBundle\Entity\art 
     */
    public function getArt()
    {
        return $this->art;
    }
}