<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="match_player_statistics", uniqueConstraints={@ORM\UniqueConstraint(columns={"player_id", "match_id"})})
 */
class MatchPlayerStatistics
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
     * @ORM\ManyToOne(targetEntity="Match")
     * @var Match
     */
    protected $match;



    
    /**
     * @ORM\Column(type="string", length=32, name="position_text")
     * @var string
     */
    protected $positionText;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="shirt_no")
     * @var int
     */
    protected $shirtNo;
    
    /**
     * @ORM\Column(type="boolean", name="game_started")
     * @var boolean
     */
    protected $gameStarted;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="mins_played")
     * @var int
     */
    protected $minsPlayed;
    
    /**
     * @ORM\Column(type="boolean", name="man_of_the_match")
     * @var boolean
     */
    protected $manOfTheMatch;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="substitution_type")
     * @var int
     */
    protected $substitutionType;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="substitution_minute")
     * @var int
     */
    protected $substitutionMinute;
    
    /**
     * @ORM\Column(type="decimal", precision=4, scale=2, name="rating")
     * @var float
     */
    protected $rating;



    
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set positionText
     *
     * @param string $positionText
     *
     * @return MatchPlayerStatistics
     */
    public function setPositionText($positionText)
    {
        $this->positionText = $positionText;

        return $this;
    }

    /**
     * Get positionText
     *
     * @return string
     */
    public function getPositionText()
    {
        return $this->positionText;
    }

    /**
     * Set shirtNo
     *
     * @param integer $shirtNo
     *
     * @return MatchPlayerStatistics
     */
    public function setShirtNo($shirtNo)
    {
        $this->shirtNo = $shirtNo;

        return $this;
    }

    /**
     * Get shirtNo
     *
     * @return integer
     */
    public function getShirtNo()
    {
        return $this->shirtNo;
    }

    /**
     * Set gameStarted
     *
     * @param boolean $gameStarted
     *
     * @return MatchPlayerStatistics
     */
    public function setGameStarted($gameStarted)
    {
        $this->gameStarted = $gameStarted;

        return $this;
    }

    /**
     * Get gameStarted
     *
     * @return boolean
     */
    public function getGameStarted()
    {
        return $this->gameStarted;
    }

    /**
     * Set minsPlayed
     *
     * @param integer $minsPlayed
     *
     * @return MatchPlayerStatistics
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
     * @param boolean $manOfTheMatch
     *
     * @return MatchPlayerStatistics
     */
    public function setManOfTheMatch($manOfTheMatch)
    {
        $this->manOfTheMatch = $manOfTheMatch;

        return $this;
    }

    /**
     * Get manOfTheMatch
     *
     * @return boolean
     */
    public function getManOfTheMatch()
    {
        return $this->manOfTheMatch;
    }

    /**
     * Set substitutionType
     *
     * @param integer $substitutionType
     *
     * @return MatchPlayerStatistics
     */
    public function setSubstitutionType($substitutionType)
    {
        $this->substitutionType = $substitutionType;

        return $this;
    }

    /**
     * Get substitutionType
     *
     * @return integer
     */
    public function getSubstitutionType()
    {
        return $this->substitutionType;
    }

    /**
     * Set substitutionMinute
     *
     * @param integer $substitutionMinute
     *
     * @return MatchPlayerStatistics
     */
    public function setSubstitutionMinute($substitutionMinute)
    {
        $this->substitutionMinute = $substitutionMinute;

        return $this;
    }

    /**
     * Get substitutionMinute
     *
     * @return integer
     */
    public function getSubstitutionMinute()
    {
        return $this->substitutionMinute;
    }

    /**
     * Set rating
     *
     * @param string $rating
     *
     * @return MatchPlayerStatistics
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set goalsScored
     *
     * @param integer $goalsScored
     *
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * @return MatchPlayerStatistics
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
     * Set player
     *
     * @param Player $player
     *
     * @return MatchPlayerStatistics
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
     * Set match
     *
     * @param Match $match
     *
     * @return MatchPlayerStatistics
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
