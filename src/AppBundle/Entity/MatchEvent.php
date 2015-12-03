<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match_event")
 */
class MatchEvent
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Match")
     * @var Match
     */
    protected $match;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @var Player
     */
    protected $player;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @ORM\JoinColumn(name="participating_player_id", referencedColumnName="id")
     * @var Player
     */
    protected $participatingPlayer;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="side")
     * @var int
     */
    protected $side;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="minute")
     * @var int
     */
    protected $minute;
    
    /**
     * @ORM\Column(type="string", length=32, name="event_type")
     * @var string
     */
    protected $eventType;
    
    /**
     * @ORM\Column(type="string", length=32, name="info")
     * @var string
     */
    protected $info;
    
    /**
     * @ORM\Column(type="string", length=32, name="running_score")
     * @var string
     */
    protected $runningScore;

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
     * Set side
     *
     * @param int $side
     * @return MatchEvent
     */
    public function setSide($side)
    {
        $this->side = $side;
    
        return $this;
    }

    /**
     * Get side
     *
     * @return int
     */
    public function getSide()
    {
        return $this->side;
    }

    /**
     * Set minute
     *
     * @param int $minute
     * @return MatchEvent
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;
    
        return $this;
    }

    /**
     * Get minute
     *
     * @return int
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set eventType
     *
     * @param string $eventType
     * @return MatchEvent
     */
    public function setEventType($eventType)
    {
        $this->eventType = $eventType;
    
        return $this;
    }

    /**
     * Get eventType
     *
     * @return string
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set info
     *
     * @param string $info
     * @return MatchEvent
     */
    public function setInfo($info)
    {
        $this->info = $info;
    
        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set runningScore
     *
     * @param string $runningScore
     * @return MatchEvent
     */
    public function setRunningScore($runningScore)
    {
        $this->runningScore = $runningScore;
    
        return $this;
    }

    /**
     * Get runningScore
     *
     * @return string
     */
    public function getRunningScore()
    {
        return $this->runningScore;
    }

    /**
     * Set match
     *
     * @param Match $match
     * @return MatchEvent
     */
    public function setMatch(Match $match)
    {
        $this->match = $match;
    
        return $this;
    }

    /**
     * Get match
     *
     * @return Match
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * Set player
     *
     * @param Player $player
     * @return MatchEvent
     */
    public function setPlayer(Player $player)
    {
        $this->player = $player;
    
        return $this;
    }

    /**
     * Get player
     *
     * @return Player
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set participatingPlayer
     *
     * @param Player $participatingPlayer
     * @return MatchEvent
     */
    public function setParticipatingPlayer(Player $participatingPlayer = null)
    {
        $this->participatingPlayer = $participatingPlayer;
    
        return $this;
    }

    /**
     * Get participatingPlayer
     *
     * @return Player
     */
    public function getParticipatingPlayer()
    {
        return $this->participatingPlayer;
    }
}