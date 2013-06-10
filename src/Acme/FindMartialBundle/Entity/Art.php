<?php
// src/Acme/FindMartialBundle/Entity/Art.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_art")
 */
class Art
{
 
     /**
     * @ORM\OneToMany(targetEntity="MasterArt", mappedBy="art", cascade={"persist", "remove"})
     **/
    protected $masterArts;

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
    * @ORM\Column(type="string", columnDefinition="ENUM('classic', 'pervert')", nullable = true)
    */
    protected $type;

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
     * @return Art
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
     * Set type
     *
     * @param string $type
     * @return Art
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }


    public function __construct()
    {
        $this->masterArts     = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add masterArts
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masterArts
     * @return Art
     */
    public function addMasterArt(\Acme\FindMartialBundle\Entity\MasterArt $masterArts)
    {
        $masterArts->setArt($this);

        $this->masterArts[] = $masterArts;

        return $this;
    }

    /**
     * Remove masterArts
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masterArts
     */
    public function removeMasterArt(\Acme\FindMartialBundle\Entity\MasterArt $masterArts)
    {
        $this->masterArts->removeElement($masterArts);
    }

    /**
     * Get masterArts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMasterArts()
    {
        return $this->masterArts;
    }
}
