<?php
// src/Acme/FindMartialBundle/Entity/MasterArt.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_master_art")
 */
class MasterArt
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Master")
     */
    protected $master;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Art")
     */
    protected $art;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    private $expirience;

    /**
    * @ORM\Column(type="smallint", nullable = true)
    */
    private $training_exp;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $is_checked = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $master_approve = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $club_approve = false;

    public function __construct($master, $art)
    {
		$this->master 	= $master;
		$this->art 	= $art;

    }

    /**
     * Set expirience
     *
     * @param integer $expirience
     * @return MasterArt
     */
    public function setExpirience($expirience)
    {
        $this->expirience = $expirience;

        return $this;
    }

    /**
     * Get expirience
     *
     * @return integer 
     */
    public function getExpirience()
    {
        return $this->expirience;
    }

    /**
     * Set training_exp
     *
     * @param integer $trainingExp
     * @return MasterArt
     */
    public function setTrainingExp($trainingExp)
    {
        $this->training_exp = $trainingExp;

        return $this;
    }

    /**
     * Get training_exp
     *
     * @return integer 
     */
    public function getTrainingExp()
    {
        return $this->training_exp;
    }

    /**
     * Set is_checked
     *
     * @param boolean $isChecked
     * @return MasterArt
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
     * Set master_approve
     *
     * @param boolean $masterApprove
     * @return MasterArt
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
     * @return MasterArt
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
     * @return MasterArt
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
     * Set art
     *
     * @param \Acme\FindMartialBundle\Entity\Art $art
     * @return MasterArt
     */
    public function setArt(\Acme\FindMartialBundle\Entity\Art $art)
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
}
