<?php
// src/Acme/FindMartialBundle/Entity/AddServ.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_addserv")
 */
class AddServ
{

    /**
     * @ORM\ManyToMany(targetEntity="Club", mappedBy="servises")
     **/
    protected $clubs;
  
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

    public function __construct()
    {
		$this->clubs     = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function __toString()
    {
      return $this->getName();
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
     * @return AddServ
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
     * Add clubs
     *
     * @param \Acme\FindMartialBundle\Entity\Club $clubs
     * @return AddServ
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
}
