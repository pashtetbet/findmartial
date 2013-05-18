<?php
// src/Acme/FindMartialBundle/Entity/MasterClub.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_master_club")
 */
class MasterClub
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Master")
     */
    protected $master;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Club")
     */
    protected $club;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $master_approve = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $club_approve = false;

    public function __construct($master, $club)
    {
		$this->master 	= $master;
		$this->club 	= $club;

    }

    /**
     * Set master_approve
     *
     * @param boolean $masterApprove
     * @return MasterClub
     */
    public function setMasterApprove($masterApprove)
    {
        $this->master_approve = $masterApprove;
    
        return $this;
    }

    /**
     * Get master_approve
     *
     * @return boolean 
     */
    public function getMasterApprove()
    {
        return $this->master_approve;
    }

    /**
     * Set club_approve
     *
     * @param boolean $clubApprove
     * @return MasterClub
     */
    public function setClubApprove($clubApprove)
    {
        $this->club_approve = $clubApprove;
    
        return $this;
    }

    /**
     * Get club_approve
     *
     * @return boolean 
     */
    public function getClubApprove()
    {
        return $this->club_approve;
    }

    /**
     * Set master
     *
     * @param \Acme\FindMartialBundle\Entity\Master $master
     * @return MasterClub
     */
    public function setMaster(\Acme\FindMartialBundle\Entity\Master $master)
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
     * @param \Acme\FindMartialBundle\Entity\Club $club
     * @return MasterClub
     */
    public function setClub(\Acme\FindMartialBundle\Entity\Club $club)
    {
        $this->club = $club;
    
        return $this;
    }

    /**
     * Get club
     *
     * @return \Acme\FindMartialBundle\Entity\Club 
     */
    public function getClub()
    {
        return $this->club;
    }
}