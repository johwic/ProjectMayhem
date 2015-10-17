<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match_team_statistics", uniqueConstraints={@ORM\UniqueConstraint(columns={"team_id", "match_id"})})
 */
class MatchTeamStatistics
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @var Team
     */
    protected $team;
    
    /**
     * @ORM\ManyToOne(targetEntity="Match")
     * @var Match
     */
    protected $match;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="goals_scored")
     * @var int
     */
    protected $goalsScored;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="goals_conceded")
     * @var int
     */
    protected $goalsConceded;
    
    /**
     * @ORM\Column(type="decimal", precision=4, scale=1, name="possession")
     * @var float
     */
    protected $possession;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_passes")
     * @var int
     */
    protected $totalPasses;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="accurate_passes")
     * @var int
     */
    protected $accuratePasses;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="aerial_won")
     * @var int
     */
    protected $aerialWon;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="aerial_lost")
     * @var int
     */
    protected $aerialLost;
    
    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, name="overall_rating")
     * @var float
     */
    protected $overallRating;
    
    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, name="defensive_rating")
     * @var float
     */
    protected $defensiveRating;
    
    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, name="offensive_rating")
     * @var float
     */
    protected $offensiveRating;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_conceded_in_box")
     * @var int
     */
    protected $shotsConcededInBox;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_conceded_out_box")
     * @var int
     */
    protected $shotsConcededOutBox;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_tackles")
     * @var int
     */
    protected $totalTackles;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="interceptions")
     * @var int
     */
    protected $interceptions;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="fouls")
     * @var int
     */
    protected $fouls;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="was_fouled")
     * @var int
     */
    protected $wasFouled;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_shots")
     * @var int
     */
    protected $totalShots;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_on_target")
     * @var int
     */
    protected $shotsOnTarget;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_blocked")
     * @var int
     */
    protected $shotsBlocked;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dribbles")
     * @var int
     */
    protected $dribbles;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="offsides")
     * @var int
     */
    protected $offsides;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="corners_won")
     * @var int
     */
    protected $cornersWon;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="corners_lost")
     * @var int
     */
    protected $cornersLost;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_corners_into_box")
     * @var int
     */
    protected $totalCornersIntoBox;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="accurate_corners_into_box")
     * @var int
     */
    protected $accurateCornersIntoBox;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="throws")
     * @var int
     */
    protected $throws;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dispossessed")
     * @var int
     */
    protected $dispossessed;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_clearances")
     * @var int
     */
    protected $totalClearances;

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
     * Set goalsScored
     *
     * @param integer $goalsScored
     * @return MatchTeamStatistics
     */
    public function setGoalsScored($goalsScored)
    {
        $this->goalsScored = $goalsScored;
    
        return $this;
    }

    /**
     * Get goalsScored
     *
     * @return integer
     */
    public function getGoalsScored()
    {
        return $this->goalsScored;
    }

    /**
     * Set goalsConceded
     *
     * @param integer $goalsConceded
     * @return MatchTeamStatistics
     */
    public function setGoalsConceded($goalsConceded)
    {
        $this->goalsConceded = $goalsConceded;
    
        return $this;
    }

    /**
     * Get goalsConceded
     *
     * @return integer
     */
    public function getGoalsConceded()
    {
        return $this->goalsConceded;
    }

    /**
     * Set possession
     *
     * @param float $possession
     * @return MatchTeamStatistics
     */
    public function setPossession($possession)
    {
        $this->possession = $possession;
    
        return $this;
    }

    /**
     * Get possession
     *
     * @return float
     */
    public function getPossession()
    {
        return $this->possession;
    }

    /**
     * Set totalPasses
     *
     * @param integer $totalPasses
     * @return MatchTeamStatistics
     */
    public function setTotalPasses($totalPasses)
    {
        $this->totalPasses = $totalPasses;
    
        return $this;
    }

    /**
     * Get totalPasses
     *
     * @return integer
     */
    public function getTotalPasses()
    {
        return $this->totalPasses;
    }

    /**
     * Set accuratePasses
     *
     * @param integer $accuratePasses
     * @return MatchTeamStatistics
     */
    public function setAccuratePasses($accuratePasses)
    {
        $this->accuratePasses = $accuratePasses;
    
        return $this;
    }

    /**
     * Get accuratePasses
     *
     * @return integer
     */
    public function getAccuratePasses()
    {
        return $this->accuratePasses;
    }

    /**
     * Set aerialWon
     *
     * @param integer $aerialWon
     * @return MatchTeamStatistics
     */
    public function setAerialWon($aerialWon)
    {
        $this->aerialWon = $aerialWon;
    
        return $this;
    }

    /**
     * Get aerialWon
     *
     * @return integer
     */
    public function getAerialWon()
    {
        return $this->aerialWon;
    }

    /**
     * Set aerialLost
     *
     * @param integer $aerialLost
     * @return MatchTeamStatistics
     */
    public function setAerialLost($aerialLost)
    {
        $this->aerialLost = $aerialLost;
    
        return $this;
    }

    /**
     * Get aerialLost
     *
     * @return integer
     */
    public function getAerialLost()
    {
        return $this->aerialLost;
    }

    /**
     * Set overallRating
     *
     * @param float $overallRating
     * @return MatchTeamStatistics
     */
    public function setOverallRating($overallRating)
    {
        $this->overallRating = $overallRating;
    
        return $this;
    }

    /**
     * Get overallRating
     *
     * @return float
     */
    public function getOverallRating()
    {
        return $this->overallRating;
    }

    /**
     * Set defensiveRating
     *
     * @param float $defensiveRating
     * @return MatchTeamStatistics
     */
    public function setDefensiveRating($defensiveRating)
    {
        $this->defensiveRating = $defensiveRating;
    
        return $this;
    }

    /**
     * Get defensiveRating
     *
     * @return float
     */
    public function getDefensiveRating()
    {
        return $this->defensiveRating;
    }

    /**
     * Set offensiveRating
     *
     * @param float $offensiveRating
     * @return MatchTeamStatistics
     */
    public function setOffensiveRating($offensiveRating)
    {
        $this->offensiveRating = $offensiveRating;
    
        return $this;
    }

    /**
     * Get offensiveRating
     *
     * @return float
     */
    public function getOffensiveRating()
    {
        return $this->offensiveRating;
    }

    /**
     * Set shotsConcededInBox
     *
     * @param integer $shotsConcededInBox
     * @return MatchTeamStatistics
     */
    public function setShotsConcededInBox($shotsConcededInBox)
    {
        $this->shotsConcededInBox = $shotsConcededInBox;
    
        return $this;
    }

    /**
     * Get shotsConcededInBox
     *
     * @return integer
     */
    public function getShotsConcededInBox()
    {
        return $this->shotsConcededInBox;
    }

    /**
     * Set shotsConcededOutBox
     *
     * @param integer $shotsConcededOutBox
     * @return MatchTeamStatistics
     */
    public function setShotsConcededOutBox($shotsConcededOutBox)
    {
        $this->shotsConcededOutBox = $shotsConcededOutBox;
    
        return $this;
    }

    /**
     * Get shotsConcededOutBox
     *
     * @return integer
     */
    public function getShotsConcededOutBox()
    {
        return $this->shotsConcededOutBox;
    }

    /**
     * Set totalTackles
     *
     * @param integer $totalTackles
     * @return MatchTeamStatistics
     */
    public function setTotalTackles($totalTackles)
    {
        $this->totalTackles = $totalTackles;
    
        return $this;
    }

    /**
     * Get totalTackles
     *
     * @return integer
     */
    public function getTotalTackles()
    {
        return $this->totalTackles;
    }

    /**
     * Set interceptions
     *
     * @param integer $interceptions
     * @return MatchTeamStatistics
     */
    public function setInterceptions($interceptions)
    {
        $this->interceptions = $interceptions;
    
        return $this;
    }

    /**
     * Get interceptions
     *
     * @return integer
     */
    public function getInterceptions()
    {
        return $this->interceptions;
    }

    /**
     * Set fouls
     *
     * @param integer $fouls
     * @return MatchTeamStatistics
     */
    public function setFouls($fouls)
    {
        $this->fouls = $fouls;
    
        return $this;
    }

    /**
     * Get fouls
     *
     * @return integer
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * Set wasFouled
     *
     * @param integer $wasFouled
     * @return MatchTeamStatistics
     */
    public function setWasFouled($wasFouled)
    {
        $this->wasFouled = $wasFouled;
    
        return $this;
    }

    /**
     * Get wasFouled
     *
     * @return integer
     */
    public function getWasFouled()
    {
        return $this->wasFouled;
    }

    /**
     * Set totalShots
     *
     * @param integer $totalShots
     * @return MatchTeamStatistics
     */
    public function setTotalShots($totalShots)
    {
        $this->totalShots = $totalShots;
    
        return $this;
    }

    /**
     * Get totalShots
     *
     * @return integer
     */
    public function getTotalShots()
    {
        return $this->totalShots;
    }

    /**
     * Set shotsOnTarget
     *
     * @param integer $shotsOnTarget
     * @return MatchTeamStatistics
     */
    public function setShotsOnTarget($shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;
    
        return $this;
    }

    /**
     * Get shotsOnTarget
     *
     * @return integer
     */
    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    /**
     * Set shotsBlocked
     *
     * @param integer $shotsBlocked
     * @return MatchTeamStatistics
     */
    public function setShotsBlocked($shotsBlocked)
    {
        $this->shotsBlocked = $shotsBlocked;
    
        return $this;
    }

    /**
     * Get shotsBlocked
     *
     * @return integer
     */
    public function getShotsBlocked()
    {
        return $this->shotsBlocked;
    }

    /**
     * Set dribbles
     *
     * @param integer $dribbles
     * @return MatchTeamStatistics
     */
    public function setDribbles($dribbles)
    {
        $this->dribbles = $dribbles;
    
        return $this;
    }

    /**
     * Get dribbles
     *
     * @return integer
     */
    public function getDribbles()
    {
        return $this->dribbles;
    }

    /**
     * Set offsides
     *
     * @param integer $offsides
     * @return MatchTeamStatistics
     */
    public function setOffsides($offsides)
    {
        $this->offsides = $offsides;
    
        return $this;
    }

    /**
     * Get offsides
     *
     * @return integer
     */
    public function getOffsides()
    {
        return $this->offsides;
    }

    /**
     * Set cornersWon
     *
     * @param integer $cornersWon
     * @return MatchTeamStatistics
     */
    public function setCornersWon($cornersWon)
    {
        $this->cornersWon = $cornersWon;
    
        return $this;
    }

    /**
     * Get cornersWon
     *
     * @return integer
     */
    public function getCornersWon()
    {
        return $this->cornersWon;
    }

    /**
     * Set cornersLost
     *
     * @param integer $cornersLost
     * @return MatchTeamStatistics
     */
    public function setCornersLost($cornersLost)
    {
        $this->cornersLost = $cornersLost;
    
        return $this;
    }

    /**
     * Get cornersLost
     *
     * @return integer
     */
    public function getCornersLost()
    {
        return $this->cornersLost;
    }

    /**
     * Set totalCornersIntoBox
     *
     * @param integer $totalCornersIntoBox
     * @return MatchTeamStatistics
     */
    public function setTotalCornersIntoBox($totalCornersIntoBox)
    {
        $this->totalCornersIntoBox = $totalCornersIntoBox;
    
        return $this;
    }

    /**
     * Get totalCornersIntoBox
     *
     * @return integer
     */
    public function getTotalCornersIntoBox()
    {
        return $this->totalCornersIntoBox;
    }

    /**
     * Set accurateCornersIntoBox
     *
     * @param integer $accurateCornersIntoBox
     * @return MatchTeamStatistics
     */
    public function setAccurateCornersIntoBox($accurateCornersIntoBox)
    {
        $this->accurateCornersIntoBox = $accurateCornersIntoBox;
    
        return $this;
    }

    /**
     * Get accurateCornersIntoBox
     *
     * @return integer
     */
    public function getAccurateCornersIntoBox()
    {
        return $this->accurateCornersIntoBox;
    }

    /**
     * Set throws
     *
     * @param integer $throws
     * @return MatchTeamStatistics
     */
    public function setThrows($throws)
    {
        $this->throws = $throws;
    
        return $this;
    }

    /**
     * Get throws
     *
     * @return integer
     */
    public function getThrows()
    {
        return $this->throws;
    }

    /**
     * Set dispossessed
     *
     * @param integer $dispossessed
     * @return MatchTeamStatistics
     */
    public function setDispossessed($dispossessed)
    {
        $this->dispossessed = $dispossessed;
    
        return $this;
    }

    /**
     * Get dispossessed
     *
     * @return integer
     */
    public function getDispossessed()
    {
        return $this->dispossessed;
    }

    /**
     * Set totalClearances
     *
     * @param integer $totalClearances
     * @return MatchTeamStatistics
     */
    public function setTotalClearances($totalClearances)
    {
        $this->totalClearances = $totalClearances;
    
        return $this;
    }

    /**
     * Get totalClearances
     *
     * @return integer
     */
    public function getTotalClearances()
    {
        return $this->totalClearances;
    }

    /**
     * Set team
     *
     * @param Team $team
     * @return MatchTeamStatistics
     */
    public function setTeam(Team $team = null)
    {
        $this->team = $team;
    
        return $this;
    }

    /**
     * Get team
     *
     * @return Team
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set match
     *
     * @param Match $match
     * @return MatchTeamStatistics
     */
    public function setMatch(Match $match = null)
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
}