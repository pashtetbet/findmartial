<?php
// src/Acme/FindMartialBundle/Entity/MasterClient.php

namespace Acme\FindMartialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_master_client")
 */
class MasterClient
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Master", inversedBy="clients")
     */
    protected $master;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="masters")
     */
    protected $client;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $master_approve = false;

    /**
    * @ORM\Column(type="boolean")
    */
    protected $client_approve = false;

    public function __construct($master, $client)
    {
		$this->master 	= $master;
		$this->client 	= $client;
    }


    /**
     * Set master_approve
     *
     * @param boolean $masterApprove
     * @return MasterClient
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
     * Set client_approve
     *
     * @param boolean $clientApprove
     * @return MasterClient
     */
    public function setClientApprove($clientApprove)
    {
        $this->client_approve = $clientApprove;

        return $this;
    }

    /**
     * Get client_approve
     *
     * @return boolean 
     */
    public function getClientApprove()
    {
        return $this->client_approve;
    }

    /**
     * Set master
     *
     * @param \Acme\FindMartialBundle\Entity\Master $master
     * @return MasterClient
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
     * Set client
     *
     * @param \Acme\FindMartialBundle\Entity\Client $client
     * @return MasterClient
     */
    public function setClient(\Acme\FindMartialBundle\Entity\Client $client)
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
