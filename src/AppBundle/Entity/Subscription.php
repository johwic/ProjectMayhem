<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscription")
 */
class Subscription
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Stage")
     * @var Stage
     */
    protected $stage;

    /**
     * @ORM\Column(type="boolean")
     * @var int
     */
    protected $subscribed;

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
     * Set subscribed
     *
     * @param boolean $subscribed
     *
     * @return Subscription
     */
    public function setSubscribed($subscribed)
    {
        $this->subscribed = $subscribed;

        return $this;
    }

    /**
     * Get subscribed
     *
     * @return boolean
     */
    public function isSubscribed()
    {
        return $this->subscribed;
    }

    /**
     * Set stage
     *
     * @param Stage $stage
     *
     * @return Subscription
     */
    public function setStage(Stage $stage = null)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return Stage
     */
    public function getStage()
    {
        return $this->stage;
    }
}
