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
     * @ORM\ManyToMany(targetEntity="MasterArt", mappedBy="art")
     **/
    protected $masters;
  
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

    public function __construct()
    {
		$this->masters     = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masters
     * @return Art
     */
    public function addMaster(\Acme\FindMartialBundle\Entity\MasterArt $masters)
    {
        $this->masters[] = $masters;
    
        return $this;
    }

    /**
     * Remove masters
     *
     * @param \Acme\FindMartialBundle\Entity\MasterArt $masters
     */
    public function removeMaster(\Acme\FindMartialBundle\Entity\MasterArt $masters)
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
}