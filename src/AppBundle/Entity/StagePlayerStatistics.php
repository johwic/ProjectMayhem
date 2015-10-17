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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="yellow_cards")
     * @var int
     */
    protected $yellowCards;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="red_cards")
     * @var int
     */
    protected $redCards;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="second_yellow")
     * @var int
     */
    protected $secondYellow;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="goals")
     * @var int
     */
    protected $goals;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="assists")
     * @var int
     */
    protected $assists;
    
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
     * @ORM\Column(type="decimal", precision=4, scale=2, name="rating")
     * @var float
     */
    protected $rating;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="man_of_the_match")
     * @var int
     */
    protected $manOfTheMatch;
    
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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="offsides_won")
     * @var int
     */
    protected $offsidesWon;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="total_clearances")
     * @var int
     */
    protected $totalClearances;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="was_dribbled")
     * @var int
     */
    protected $wasDribbled;
    
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
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="own_goals")
     * @var int
     */
    protected $ownGoals;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="key_passes")
     * @var int
     */
    protected $keyPasses;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="dribbles")
     * @var int
     */
    protected $dribbles;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="was_fouled")
     * @var int
     */
    protected $wasFouled;
    
    /**
     * @ORM\Column(type="smallint", options={"unsigned"=true}, name="offsides")
     * @var int
     */
    protected $offsides;
    
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
     * @ORM\Column(type="string", length=32, name="position_text")
     * @var string
     */
    protected $positionText;
    
    /**
     * @ORM\Column(type="string", length=32, name="played_positions_raw")
     * @var string
     */
    protected $playedPositionsRaw;
    
    /**
     * @ORM\Column(type="string", length=16, name="position_short")
     * @var string
     */
    protected $positionShort;
    
    /**
     * @ORM\Column(type="string", length=128, name="position_long")
     * @var string
     */
    protected $positionLong;

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
     * Set gamesStarted
     *
     * @param int $gamesStarted
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
     * @return int
     */
    public function getGamesStarted()
    {
        return $this->gamesStarted;
    }

    /**
     * Set subOn
     *
     * @param int $subOn
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
     * @return int
     */
    public function getSubOn()
    {
        return $this->subOn;
    }

    /**
     * Set subOff
     *
     * @param int $subOff
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
     * @return int
     */
    public function getSubOff()
    {
        return $this->subOff;
    }

    /**
     * Set yellowCards
     *
     * @param int $yellowCards
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
     * @return int
     */
    public function getYellowCards()
    {
        return $this->yellowCards;
    }

    /**
     * Set redCards
     *
     * @param int $redCards
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
     * @return int
     */
    public function getRedCards()
    {
        return $this->redCards;
    }

    /**
     * Set secondYellow
     *
     * @param int $secondYellow
     * @return StagePlayerStatistics
     */
    public function setSecondYellow($secondYellow)
    {
        $this->secondYellow = $secondYellow;
    
        return $this;
    }

    /**
     * Get secondYellow
     *
     * @return int
     */
    public function getSecondYellow()
    {
        return $this->secondYellow;
    }

    /**
     * Set goals
     *
     * @param int $goals
     * @return StagePlayerStatistics
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;
    
        return $this;
    }

    /**
     * Get goals
     *
     * @return int
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set assists
     *
     * @param int $assists
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
     * @return int
     */
    public function getAssists()
    {
        return $this->assists;
    }

    /**
     * Set totalPasses
     *
     * @param int $totalPasses
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
     * @return int
     */
    public function getTotalPasses()
    {
        return $this->totalPasses;
    }

    /**
     * Set accuratePasses
     *
     * @param int $accuratePasses
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
     * @return int
     */
    public function getAccuratePasses()
    {
        return $this->accuratePasses;
    }

    /**
     * Set aerialWon
     *
     * @param int $aerialWon
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
     * @return int
     */
    public function getAerialWon()
    {
        return $this->aerialWon;
    }

    /**
     * Set aerialLost
     *
     * @param int $aerialLost
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
     * @return int
     */
    public function getAerialLost()
    {
        return $this->aerialLost;
    }

    /**
     * Set rating
     *
     * @param float $rating
     * @return StagePlayerStatistics
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set manOfTheMatch
     *
     * @param int $manOfTheMatch
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
     * Set totalTackles
     *
     * @param int $totalTackles
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
     * @return int
     */
    public function getTotalTackles()
    {
        return $this->totalTackles;
    }

    /**
     * Set interceptions
     *
     * @param int $interceptions
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
     * @return int
     */
    public function getInterceptions()
    {
        return $this->interceptions;
    }

    /**
     * Set fouls
     *
     * @param int $fouls
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
     * @return int
     */
    public function getFouls()
    {
        return $this->fouls;
    }

    /**
     * Set offsidesWon
     *
     * @param int $offsidesWon
     * @return StagePlayerStatistics
     */
    public function setOffsidesWon($offsidesWon)
    {
        $this->offsidesWon = $offsidesWon;
    
        return $this;
    }

    /**
     * Get offsidesWon
     *
     * @return int
     */
    public function getOffsidesWon()
    {
        return $this->offsidesWon;
    }

    /**
     * Set totalClearances
     *
     * @param int $totalClearances
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
     * @return int
     */
    public function getTotalClearances()
    {
        return $this->totalClearances;
    }

    /**
     * Set wasDribbled
     *
     * @param int $wasDribbled
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
     * @return int
     */
    public function getWasDribbled()
    {
        return $this->wasDribbled;
    }

    /**
     * Set shotsOnTarget
     *
     * @param int $shotsOnTarget
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
     * @return int
     */
    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    /**
     * Set shotsBlocked
     *
     * @param int $shotsBlocked
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
     * @return int
     */
    public function getShotsBlocked()
    {
        return $this->shotsBlocked;
    }

    /**
     * Set ownGoals
     *
     * @param int $ownGoals
     * @return StagePlayerStatistics
     */
    public function setOwnGoals($ownGoals)
    {
        $this->ownGoals = $ownGoals;
    
        return $this;
    }

    /**
     * Get ownGoals
     *
     * @return int
     */
    public function getOwnGoals()
    {
        return $this->ownGoals;
    }

    /**
     * Set keyPasses
     *
     * @param int $keyPasses
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
     * @return int
     */
    public function getKeyPasses()
    {
        return $this->keyPasses;
    }

    /**
     * Set dribbles
     *
     * @param int $dribbles
     * @return StagePlayerStatistics
     */
    public function setDribbles($dribbles)
    {
        $this->dribbles = $dribbles;
    
        return $this;
    }

    /**
     * Get dribbles
     *
     * @return int
     */
    public function getDribbles()
    {
        return $this->dribbles;
    }

    /**
     * Set wasFouled
     *
     * @param int $wasFouled
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
     * @return int
     */
    public function getWasFouled()
    {
        return $this->wasFouled;
    }

    /**
     * Set offsides
     *
     * @param int $offsides
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
     * @return int
     */
    public function getOffsides()
    {
        return $this->offsides;
    }

    /**
     * Set dispossessed
     *
     * @param int $dispossessed
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
     * @return int
     */
    public function getDispossessed()
    {
        return $this->dispossessed;
    }

    /**
     * Set turnovers
     *
     * @param int $turnovers
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
     * @return int
     */
    public function getTurnovers()
    {
        return $this->turnovers;
    }

    /**
     * Set totalCrosses
     *
     * @param int $totalCrosses
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
     * @return int
     */
    public function getTotalCrosses()
    {
        return $this->totalCrosses;
    }

    /**
     * Set accurateCrosses
     *
     * @param int $accurateCrosses
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
     * @return int
     */
    public function getAccurateCrosses()
    {
        return $this->accurateCrosses;
    }

    /**
     * Set totalLongBalls
     *
     * @param int $totalLongBalls
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
     * @return int
     */
    public function getTotalLongBalls()
    {
        return $this->totalLongBalls;
    }

    /**
     * Set accurateLongBalls
     *
     * @param int $accurateLongBalls
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
     * @return int
     */
    public function getAccurateLongBalls()
    {
        return $this->accurateLongBalls;
    }

    /**
     * Set totalThroughBalls
     *
     * @param int $totalThroughBalls
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
     * @return int
     */
    public function getTotalThroughBalls()
    {
        return $this->totalThroughBalls;
    }

    /**
     * Set accurateThroughBalls
     *
     * @param int $accurateThroughBalls
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
     * @return int
     */
    public function getAccurateThroughBalls()
    {
        return $this->accurateThroughBalls;
    }

    /**
     * Set positionText
     *
     * @param string $positionText
     * @return StagePlayerStatistics
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
     * Set playedPositionsRaw
     *
     * @param string $playedPositionsRaw
     * @return StagePlayerStatistics
     */
    public function setPlayedPositionsRaw($playedPositionsRaw)
    {
        $this->playedPositionsRaw = $playedPositionsRaw;
    
        return $this;
    }

    /**
     * Get playedPositionsRaw
     *
     * @return string
     */
    public function getPlayedPositionsRaw()
    {
        return $this->playedPositionsRaw;
    }

    /**
     * Set positionShort
     *
     * @param string $positionShort
     * @return StagePlayerStatistics
     */
    public function setPositionShort($positionShort)
    {
        $this->positionShort = $positionShort;
    
        return $this;
    }

    /**
     * Get positionShort
     *
     * @return string
     */
    public function getPositionShort()
    {
        return $this->positionShort;
    }

    /**
     * Set positionLong
     *
     * @param string $positionLong
     * @return StagePlayerStatistics
     */
    public function setPositionLong($positionLong)
    {
        $this->positionLong = $positionLong;
    
        return $this;
    }

    /**
     * Get positionLong
     *
     * @return string
     */
    public function getPositionLong()
    {
        return $this->positionLong;
    }

    /**
     * Set player
     *
     * @param Player $player
     * @return StagePlayerStatistics
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
     * Set team
     *
     * @param Team $team
     * @return StagePlayerStatistics
     */
    public function setTeam(Team $team)
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
     * @return StagePlayerStatistics
     */
    public function setStage(Stage $stage)
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

    /**
     * Set totalShots
     *
     * @param int $totalShots
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
     * @return int
     */
    public function getTotalShots()
    {
        return $this->totalShots;
    }
}