<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="region", uniqueConstraints={@ORM\UniqueConstraint(columns={"ws_id"})}))
 */
class Region
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer", options={"unsigned"=true}, name="ws_id")
     * @var int
     */
    protected $wsId;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true}, name="type")
     * @var int
     */
    protected $type;
    
    /**
     * @ORM\Column(type="string", length=255, name="name")
     * @var string
     */
    protected $name;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get wsId
     *
     * @return int
     */
    public function getWsId()
    {
        return $this->wsId;
    }
    
    /**
     * Set wsId
     *
     * @param int $wsId Whoscored.com id of the region
     * @return Region
     */
    public function setWsId($wsId)
    {
        $this->wsId = $wsId;
        
        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set type
     *
     * @param int $type Whoscored.com type of region
     * @return Region
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
    
    /**
     * Set name
     *
     * @param string $name Name of the region
     * @return Region
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
}