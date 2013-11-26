<?php
// src/Acme/FindMartialBundle/Entity/Attribute.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_attribute")
 */
class Attribute
{
  
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
    protected $value;

    public function __construct()
    {
		//
    }
    
    function __toString()
    {
      return $this->getName();
    }


}