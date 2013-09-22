<?php
#src/Acme/FindMartialBundle/Entity/MasterPhoto.php
namespace Acme\FindMartialBundle\Entity;
use Iphp\FileStoreBundle\Mapping\Annotation as FileStore;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fm_master_photo")
 * @FileStore\Uploadable
 */

class MasterPhoto
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
 
     /**
     * @ORM\ManyToOne(targetEntity="Master", inversedBy="masterPhotos", cascade={"persist"})
     * @ORM\JoinColumn(name="club_id", referencedColumnName="id", nullable = true)
     */
    protected $master;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     */
    private $title;
 
     /**
     * @var \Datetime
     * @ORM\Column(type="datetime", nullable = true)
     */
    private $date;

    /**
     * @Assert\File( maxSize="20M")
     * @FileStore\UploadableField(mapping="photo")
     * @ORM\Column(type="array")
     */
    private $photo;

    function __toString()
    {
        return (string)$this->getName();
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
     * Set title
     *
     * @param string $title
     * @return MasterPhoto
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return MasterPhoto
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
     * Set photo
     *
     * @param array $photo
     * @return MasterPhoto
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return array 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set master
     *
     * @param \Acme\FindMartialBundle\Entity\Master $master
     * @return MasterPhoto
     */
    public function setMaster(\Acme\FindMartialBundle\Entity\Master $master = null)
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
}