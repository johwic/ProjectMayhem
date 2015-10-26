<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stage_player_statistics", uniqueConstraints={@ORM\UniqueConstraint(columns={"player_id", "team_id", "stage_id"})})
 */
class StagePlayerStatistics
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Player")
     * @var Player
     */
    protected $player;
    
    /**
     * @ORM\ManyToOne(targetEntity="Team")
     * @var Team
     */
    protected $team;
    
    /**
     * @ORM\ManyToOne(targetEntity="Stage")
     * @var Stage
     */
    protected $stage;




    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="goals_scored")
     * @var int
     */
    protected $goalsScored;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="own_goals_scored")
     * @var int
     */
    protected $ownGoalsScored;

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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="blocked_shots")
     * @var int
     */
    protected $blockedShots;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_hit_post")
     * @var int
     */
    protected $shotsHitPost;




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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_crosses")
     * @var int
     */
    protected $totalCrosses;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="accurate_crosses")
     * @var int
     */
    protected $accurateCrosses;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_long_balls")
     * @var int
     */
    protected $totalLongBalls;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="accurate_long_balls")
     * @var int
     */
    protected $accurateLongBalls;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_through_balls")
     * @var int
     */
    protected $totalThroughBalls;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="accurate_through_balls")
     * @var int
     */
    protected $accurateThroughBalls;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="assists")
     * @var int
     */
    protected $assists;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="key_passes")
     * @var int
     */
    protected $keyPasses;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="touches")
     * @var int
     */
    protected $touches;




    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dribbles_won")
     * @var int
     */
    protected $dribblesWon;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dribbles_lost")
     * @var int
     */
    protected $dribblesLost;


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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_tackles")
     * @var int
     */
    protected $totalTackles;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="was_dribbled")
     * @var int
     */
    protected $wasDribbled;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="interceptions")
     * @var int
     */
    protected $interceptions;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_clearances")
     * @var int
     */
    protected $totalClearances;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="effective_clearances")
     * @var int
     */
    protected $effectiveClearances;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shots_blocked")
     * @var int
     */
    protected $shotsBlocked;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="offsides_provoked")
     * @var int
     */
    protected $offsidesProvoked;

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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dispossessed")
     * @var int
     */
    protected $dispossessed;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="turnovers")
     * @var int
     */
    protected $turnovers;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="offsides")
     * @var int
     */
    protected $offsides;




    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="saves")
     * @var int
     */
    protected $saves;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="claims")
     * @var int
     */
    protected $claims;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="punches")
     * @var int
     */
    protected $punches;




    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="error_lead_goal")
     * @var int
     */
    protected $errorLeadGoal;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="error_lead_shot")
     * @var int
     */
    protected $errorLeadShot;




    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="red_cards")
     * @var int
     */
    protected $redCards;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="yellow_cards")
     * @var int
     */
    protected $yellowCards;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="second_yellow_cards")
     * @var int
     */
    protected $secondYellowCards;


    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="games_started")
     * @var int
     */
    protected $gamesStarted;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="sub_on")
     * @var int
     */
    protected $subOn;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="sub_off")
     * @var int
     */
    protected $subOff;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="mins_played")
     * @var int
     */
    protected $minsPlayed;

    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="man_of_the_match")
     * @var int
     */
    protected $manOfTheMatch;

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
     *
     * @return StagePlayerStatistics
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
     * Set ownGoalsScored
     *
     * @param integer $ownGoalsScored
     *
     * @return StagePlayerStatistics
     */
    public function setOwnGoalsScored($ownGoalsScored)
    {
        $this->ownGoalsScored = $ownGoalsScored;

        return $this;
    }

    /**
     * Get ownGoalsScored
     *
     * @return integer
     */
    public function getOwnGoalsScored()
    {
        return $this->ownGoalsScored;
    }

    /**
     * Set totalShots
     *
     * @param integer $totalShots
     *
     * @return StagePlayerStatistics
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
     *
     * @return StagePlayerStatistics
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
     * Set blockedShots
     *
     * @param integer $blockedShots
     *
     * @return StagePlayerStatistics
     */
    public function setBlockedShots($blockedShots)
    {
        $this->blockedShots = $blockedShots;

        return $this;
    }

    /**
     * Get blockedShots
     *
     * @return integer
     */
    public function getBlockedShots()
    {
        return $this->blockedShots;
    }

    /**
     * Set shotsHitPost
     *
     * @param integer $shotsHitPost
     *
     * @return StagePlayerStatistics
     */
    public function setShotsHitPost($shotsHitPost)
    {
        $this->shotsHitPost = $shotsHitPost;

        return $this;
    }

    /**
     * Get shotsHitPost
     *
     * @return integer
     */
    public function getShotsHitPost()
    {
        return $this->shotsHitPost;
    }

    /**
     * Set totalPasses
     *
     * @param integer $totalPasses
     *
     * @return StagePlayerStatistics
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
     *
     * @return StagePlayerStatistics
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
     * Set totalCrosses
     *
     * @param integer $totalCrosses
     *
     * @return StagePlayerStatistics
     */
    public function setTotalCrosses($totalCrosses)
    {
        $this->totalCrosses = $totalCrosses;

        return $this;
    }

    /**
     * Get totalCrosses
     *
     * @return integer
     */
    public function getTotalCrosses()
    {
        return $this->totalCrosses;
    }

    /**
     * Set accurateCrosses
     *
     * @param integer $accurateCrosses
     *
     * @return StagePlayerStatistics
     */
    public function setAccurateCrosses($accurateCrosses)
    {
        $this->accurateCrosses = $accurateCrosses;

        return $this;
    }

    /**
     * Get accurateCrosses
     *
     * @return integer
     */
    public function getAccurateCrosses()
    {
        return $this->accurateCrosses;
    }

    /**
     * Set totalLongBalls
     *
     * @param integer $totalLongBalls
     *
     * @return StagePlayerStatistics
     */
    public function setTotalLongBalls($totalLongBalls)
    {
        $this->totalLongBalls = $totalLongBalls;

        return $this;
    }

    /**
     * Get totalLongBalls
     *
     * @return integer
     */
    public function getTotalLongBalls()
    {
        return $this->totalLongBalls;
    }

    /**
     * Set accurateLongBalls
     *
     * @param integer $accurateLongBalls
     *
     * @return StagePlayerStatistics
     */
    public function setAccurateLongBalls($accurateLongBalls)
    {
        $this->accurateLongBalls = $accurateLongBalls;

        return $this;
    }

    /**
     * Get accurateLongBalls
     *
     * @return integer
     */
    public function getAccurateLongBalls()
    {
        return $this->accurateLongBalls;
    }

    /**
     * Set totalThroughBalls
     *
     * @param integer $totalThroughBalls
     *
     * @return StagePlayerStatistics
     */
    public function setTotalThroughBalls($totalThroughBalls)
    {
        $this->totalThroughBalls = $totalThroughBalls;

        return $this;
    }

    /**
     * Get totalThroughBalls
     *
     * @return integer
     */
    public function getTotalThroughBalls()
    {
        return $this->totalThroughBalls;
    }

    /**
     * Set accurateThroughBalls
     *
     * @param integer $accurateThroughBalls
     *
     * @return StagePlayerStatistics
     */
    public function setAccurateThroughBalls($accurateThroughBalls)
    {
        $this->accurateThroughBalls = $accurateThroughBalls;

        return $this;
    }

    /**
     * Get accurateThroughBalls
     *
     * @return integer
     */
    public function getAccurateThroughBalls()
    {
        return $this->accurateThroughBalls;
    }

    /**
     * Set assists
     *
     * @param integer $assists
     *
     * @return StagePlayerStatistics
     */
    public function setAssists($assists)
    {
        $this->assists = $assists;

        return $this;
    }

    /**
     * Get assists
     *
     * @return integer
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set keyPasses
     *
     * @param integer $keyPasses
     *
     * @return StagePlayerStatistics
     */
    public function setKeyPasses($keyPasses)
    {
        $this->keyPasses = $keyPasses;

        return $this;
    }

    /**
     * Get keyPasses
     *
     * @return integer
     */
    public function getKeyPasses()
    {
        return $this->keyPasses;
    }

    /**
     * Set touches
     *
     * @param integer $touches
     *
     * @return StagePlayerStatistics
     */
    public function setTouches($touches)
    {
        $this->touches = $touches;

        return $this;
    }

    /**
     * Get touches
     *
     * @return integer
     */
    public function getTouches()
    {
        return $this->touches;
    }

    /**
     * Set dribblesWon
     *
     * @param integer $dribblesWon
     *
     * @return StagePlayerStatistics
     */
    public function setDribblesWon($dribblesWon)
    {
        $this->dribblesWon = $dribblesWon;

        return $this;
    }

    /**
     * Get dribblesWon
     *
     * @return integer
     */
    public function getDribblesWon()
    {
        return $this->dribblesWon;
    }

    /**
     * Set dribblesLost
     *
     * @param integer $dribblesLost
     *
     * @return StagePlayerStatistics
     */
    public function setDribblesLost($dribblesLost)
    {
        $this->dribblesLost = $dribblesLost;

        return $this;
    }

    /**
     * Get dribblesLost
     *
     * @return integer
     */
    public function getDribblesLost()
    {
        return $this->dribblesLost;
    }

    /**
     * Set aerialWon
     *
     * @param integer $aerialWon
     *
     * @return StagePlayerStatistics
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
     *
     * @return StagePlayerStatistics
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
     * Set totalTackles
     *
     * @param integer $totalTackles
     *
     * @return StagePlayerStatistics
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
     * Set wasDribbled
     *
     * @param integer $wasDribbled
     *
     * @return StagePlayerStatistics
     */
    public function setWasDribbled($wasDribbled)
    {
        $this->wasDribbled = $wasDribbled;

        return $this;
    }

    /**
     * Get wasDribbled
     *
     * @return integer
     */
    public function getWasDribbled()
    {
        return $this->wasDribbled;
    }

    /**
     * Set interceptions
     *
     * @param integer $interceptions
     *
     * @return StagePlayerStatistics
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
     * Set totalClearances
     *
     * @param integer $totalClearances
     *
     * @return StagePlayerStatistics
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
     * Set effectiveClearances
     *
     * @param integer $effectiveClearances
     *
     * @return StagePlayerStatistics
     */
    public function setEffectiveClearances($effectiveClearances)
    {
        $this->effectiveClearances = $effectiveClearances;

        return $this;
    }

    /**
     * Get effectiveClearances
     *
     * @return integer
     */
    public function getEffectiveClearances()
    {
        return $this->effectiveClearances;
    }

    /**
     * Set shotsBlocked
     *
     * @param integer $shotsBlocked
     *
     * @return StagePlayerStatistics
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
     * Set offsidesProvoked
     *
     * @param integer $offsidesProvoked
     *
     * @return StagePlayerStatistics
     */
    public function setOffsidesProvoked($offsidesProvoked)
    {
        $this->offsidesProvoked = $offsidesProvoked;

        return $this;
    }

    /**
     * Get offsidesProvoked
     *
     * @return integer
     */
    public function getOffsidesProvoked()
    {
        return $this->offsidesProvoked;
    }

    /**
     * Set fouls
     *
     * @param integer $fouls
     *
     * @return StagePlayerStatistics
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
     *
     * @return StagePlayerStatistics
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
     * Set dispossessed
     *
     * @param integer $dispossessed
     *
     * @return StagePlayerStatistics
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
     * Set turnovers
     *
     * @param integer $turnovers
     *
     * @return StagePlayerStatistics
     */
    public function setTurnovers($turnovers)
    {
        $this->turnovers = $turnovers;

        return $this;
    }

    /**
     * Get turnovers
     *
     * @return integer
     */
    public function getTurnovers()
    {
        return $this->turnovers;
    }

    /**
     * Set offsides
     *
     * @param integer $offsides
     *
     * @return StagePlayerStatistics
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
     * Set saves
     *
     * @param integer $saves
     *
     * @return StagePlayerStatistics
     */
    public function setSaves($saves)
    {
        $this->saves = $saves;

        return $this;
    }

    /**
     * Get saves
     *
     * @return integer
     */
    public function getSaves()
    {
        return $this->saves;
    }

    /**
     * Set claims
     *
     * @param integer $claims
     *
     * @return StagePlayerStatistics
     */
    public function setClaims($claims)
    {
        $this->claims = $claims;

        return $this;
    }

    /**
     * Get claims
     *
     * @return integer
     */
    public function getClaims()
    {
        return $this->claims;
    }

    /**
     * Set punches
     *
     * @param integer $punches
     *
     * @return StagePlayerStatistics
     */
    public function setPunches($punches)
    {
        $this->punches = $punches;

        return $this;
    }

    /**
     * Get punches
     *
     * @return integer
     */
    public function getPunches()
    {
        return $this->punches;
    }

    /**
     * Set errorLeadGoal
     *
     * @param integer $errorLeadGoal
     *
     * @return StagePlayerStatistics
     */
    public function setErrorLeadGoal($errorLeadGoal)
    {
        $this->errorLeadGoal = $errorLeadGoal;

        return $this;
    }

    /**
     * Get errorLeadGoal
     *
     * @return integer
     */
    public function getErrorLeadGoal()
    {
        return $this->errorLeadGoal;
    }

    /**
     * Set errorLeadShot
     *
     * @param integer $errorLeadShot
     *
     * @return StagePlayerStatistics
     */
    public function setErrorLeadShot($errorLeadShot)
    {
        $this->errorLeadShot = $errorLeadShot;

        return $this;
    }

    /**
     * Get errorLeadShot
     *
     * @return integer
     */
    public function getErrorLeadShot()
    {
        return $this->errorLeadShot;
    }

    /**
     * Set redCards
     *
     * @param integer $redCards
     *
     * @return StagePlayerStatistics
     */
    public function setRedCards($redCards)
    {
        $this->redCards = $redCards;

        return $this;
    }

    /**
     * Get redCards
     *
     * @return integer
     */
    public function getRedCards()
    {
        return $this->redCards;
    }

    /**
     * Set yellowCards
     *
     * @param integer $yellowCards
     *
     * @return StagePlayerStatistics
     */
    public function setYellowCards($yellowCards)
    {
        $this->yellowCards = $yellowCards;

        return $this;
    }

    /**
     * Get yellowCards
     *
     * @return integer
     */
    public function getYellowCards()
    {
        return $this->yellowCards;
    }

    /**
     * Set secondYellowCards
     *
     * @param integer $secondYellowCards
     *
     * @return StagePlayerStatistics
     */
    public function setSecondYellowCards($secondYellowCards)
    {
        $this->secondYellowCards = $secondYellowCards;

        return $this;
    }

    /**
     * Get secondYellowCards
     *
     * @return integer
     */
    public function getSecondYellowCards()
    {
        return $this->secondYellowCards;
    }

    /**
     * Set gamesStarted
     *
     * @param integer $gamesStarted
     *
     * @return StagePlayerStatistics
     */
    public function setGamesStarted($gamesStarted)
    {
        $this->gamesStarted = $gamesStarted;

        return $this;
    }

    /**
     * Get gamesStarted
     *
     * @return integer
     */
    public function getGamesStarted()
    {
        return $this->gamesStarted;
    }

    /**
     * Set subOn
     *
     * @param integer $subOn
     *
     * @return StagePlayerStatistics
     */
    public function setSubOn($subOn)
    {
        $this->subOn = $subOn;

        return $this;
    }

    /**
     * Get subOn
     *
     * @return integer
     */
    public function getSubOn()
    {
        return $this->subOn;
    }

    /**
     * Set subOff
     *
     * @param integer $subOff
     *
     * @return StagePlayerStatistics
     */
    public function setSubOff($subOff)
    {
        $this->subOff = $subOff;

        return $this;
    }

    /**
     * Get subOff
     *
     * @return integer
     */
    public function getSubOff()
    {
        return $this->subOff;
    }

    /**
     * Set minsPlayed
     *
     * @param integer $minsPlayed
     *
     * @return StagePlayerStatistics
     */
    public function setMinsPlayed($minsPlayed)
    {
        $this->minsPlayed = $minsPlayed;

        return $this;
    }

    /**
     * Get minsPlayed
     *
     * @return integer
     */
    public function getMinsPlayed()
    {
        return $this->minsPlayed;
    }

    /**
     * Set manOfTheMatch
     *
     * @param int $manOfTheMatch
     *
     * @return StagePlayerStatistics
     */
    public function setManOfTheMatch($manOfTheMatch)
    {
        $this->manOfTheMatch = $manOfTheMatch;

        return $this;
    }

    /**
     * Get manOfTheMatch
     *
     * @return int
     */
    public function getManOfTheMatch()
    {
        return $this->manOfTheMatch;
    }

    /**
     * Set player
     *
     * @param Player $player
     *
     * @return StagePlayerStatistics
     */
    public function setPlayer(Player $player = null)
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
     * Set team
     *
     * @param Team $team
     *
     * @return StagePlayerStatistics
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
     * Set stage
     *
     * @param Stage $stage
     *
     * @return StagePlayerStatistics
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

    public function addMatchStatistics(MatchPlayerStatistics $mps)
    {
        $this->setAccurateCrosses($this->getAccurateCrosses() + $mps->getAccurateCrosses());
        $this->setAccurateLongBalls($this->getAccurateLongBalls() + $mps->getAccurateLongBalls());
        $this->setAccuratePasses($this->getAccuratePasses() + $mps->getAccuratePasses());
        $this->setAccurateThroughBalls($this->getAccurateThroughBalls() + $mps->getAccurateThroughBalls());
        $this->setAerialLost($this->getAerialLost() + $mps->getAerialLost());
        $this->setAerialWon($this->getAerialWon() + $mps->getAerialWon());
        $this->setAssists($this->getAssists() + $mps->getAssists());

        $this->setBlockedShots($this->getBlockedShots() + $mps->getBlockedShots());
        $this->setClaims($this->getClaims() + $mps->getClaims());
        $this->setDispossessed($this->getDispossessed() + $mps->getDispossessed());
        $this->setDribblesLost($this->getDribblesLost() + $mps->getDribblesLost());
        $this->setDribblesWon($this->getDribblesWon() + $mps->getDribblesWon());
        $this->setEffectiveClearances($this->getEffectiveClearances() + $mps->getEffectiveClearances());
        $this->setErrorLeadGoal($this->getErrorLeadGoal() + $mps->getErrorLeadGoal());;
        $this->setErrorLeadShot($this->getErrorLeadShot() + $mps->getErrorLeadShot());;
        $this->setFouls($this->getFouls() + $mps->getFouls());
        $this->setGamesStarted($this->getGamesStarted() + $mps->getGameStarted());
        $this->setGoalsScored($this->getGoalsScored() + $mps->getGoalsScored());
        $this->setInterceptions($this->getInterceptions() + $mps->getInterceptions());
        $this->setKeyPasses($this->getKeyPasses() + $mps->getKeyPasses());
        $this->setManOfTheMatch($this->getManOfTheMatch() + $mps->getManOfTheMatch());
        $this->setMinsPlayed($this->getMinsPlayed() + $mps->getMinsPlayed());
        $this->setOffsides($this->getOffsides() + $mps->getOffsides());
        $this->setOffsidesProvoked($this->getOffsidesProvoked() + $mps->getOffsidesProvoked());
        $this->setOwnGoalsScored($this->getOwnGoalsScored() + $mps->getOwnGoalsScored());;
        $this->setPunches($this->getPunches() + $mps->getPunches());;
        $this->setRedCards($this->getRedCards() + $mps->getRedCards());;
        $this->setSaves($this->getSaves() + $mps->getSaves());
        $this->setSecondYellowCards($this->getSecondYellowCards() + $mps->getSecondYellowCards());;
        $this->setShotsBlocked($this->getShotsBlocked() + $mps->getShotsBlocked());
        $this->setShotsHitPost($this->getShotsHitPost() + $mps->getShotsHitPost());
        $this->setShotsOnTarget($this->getShotsOnTarget() + $mps->getShotsOnTarget());
        if ($mps->getSubstitutionType() == 1) {
            $this->setSubOff($this->getSubOff() + 1);
            $this->setSubOn(($this->getSubOn() == null) ? 0 : $this->getSubOn());
        } elseif ($mps->getSubstitutionType() == 2) {
            $this->setSubOn($this->getSubOn() + 1);
            $this->setSubOff(($this->getSubOff() == null) ? 0 : $this->getSubOff());
        } else {
            $this->setSubOff(($this->getSubOff() == null) ? 0 : $this->getSubOff());
            $this->setSubOn(($this->getSubOn() == null) ? 0 : $this->getSubOn());
        }
        $this->setTotalClearances($this->getTotalClearances() + $mps->getTotalClearances());
        $this->setTotalCrosses($this->getTotalCrosses() + $mps->getTotalCrosses());
        $this->setTotalLongBalls($this->getTotalLongBalls() + $mps->getTotalLongBalls());
        $this->setTotalPasses($this->getTotalPasses() + $mps->getTotalPasses());
        $this->setTotalShots($this->getTotalShots() + $mps->getTotalShots());
        $this->setTotalTackles($this->getTotalTackles() + $mps->getTotalTackles());
        $this->setTotalThroughBalls($this->getTotalThroughBalls() + $mps->getTotalThroughBalls());
        $this->setTouches($this->getTouches() + $mps->getTouches());
        $this->setTurnovers($this->getTurnovers() + $mps->getTurnovers());
        $this->setWasDribbled($this->getWasDribbled() + $mps->getWasDribbled());;
        $this->setWasFouled($this->getWasFouled() + $mps->getWasFouled());
        $this->setYellowCards($this->getYellowCards() + $mps->getYellowCards());;
    }
}
