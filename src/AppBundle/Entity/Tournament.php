<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tournament", uniqueConstraints={@ORM\UniqueConstraint(columns={"ws_id"})})
 */
class Tournament
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
     * @ORM\Column(type="string", length=255, name="name")
     * @var string
     */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="tournaments")
     * @var Region
     */
    protected $region;

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
     * @param int $wsId Whoscored.com id of the Tournament
     * @return Tournament
     */
    public function setWsId($wsId)
    {
        $this->wsId = $wsId;
        
        return $this;
    }
    
    /**
     * Set name
     *
     * @param string $name Name of the Tournament
     * @return Tournament
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
     * Set region
     *
     * @param Region $region The region
     * @return Tournament
     */
    public function setRegion(Region $region)
    {
        //$region->addTournament($this);
        $this->region = $region;
        
        return $this;
    }

    /**
     * Get region
     *
     * @return Region
     */
    public function getRegion()
    {
        return $this->region;
    }

    public function __toString()
    {
        return $this->getName();
    }
}