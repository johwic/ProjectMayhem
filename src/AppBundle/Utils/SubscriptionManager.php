<?php

namespace AppBundle\Utils;

use AppBundle\Entity\MatchPlayerStatistics;
use AppBundle\Entity\Player;
use AppBundle\Entity\Stage;
use AppBundle\Entity\Match;
use AppBundle\Entity\MatchEvent;
use AppBundle\Entity\Region;
use AppBundle\Entity\Team;
use AppBundle\Entity\Tournament;
use AppBundle\Entity\StagePlayerStatistics;
use DateTime;
use DateTimeZone;
use Doctrine\ORM\EntityManager;

//use DateTime;

class SubscriptionManager
{
    private $whoscored;
    private $em;
    private $players = array();

    public function __construct(WhoscoredProvider $whoscored, EntityManager $em)
    {
        $this->whoscored = $whoscored;
        $this->em = $em;
    }

    public function getFixtures(Stage $stage, $week)
    {
        try {
            $fixtures = $this->whoscored->loadStatistics('stagefixtures', array('stageId' => $stage->getWsId(), 'd' => $week, 'isAggregate' => false));
        } catch (\Exception $e) {
            throw $e;
        }
        $rows_affected = 0;

        foreach ($fixtures as $fixture) {
            $matchId = $fixture[0];
            $count = $this->em->createQuery('SELECT COUNT(m) FROM AppBundle:Match m WHERE m.wsId = :id')->setParameter(':id', $matchId)->getSingleScalarResult();
            if ($count == 1) continue;

            $homeTeam = $this->getTeam($fixture[4]);
            $awayTeam = $this->getTeam($fixture[7]);

            $match = new Match();
            $match->setStage($stage);
            $match->setWsId($matchId);
            $time = DateTime::createFromFormat('D, M j Y H:i', $fixture[2] . ' ' . $fixture[3], new DateTimeZone('UTC'))->getTimestamp();
            $match->setTime($time);
            $match->setHomeTeam($homeTeam);
            $match->setAwayTeam($awayTeam);
            $match->setStatus(0);

            $this->em->persist($match);
            $rows_affected++;
        }

        $this->em->flush();

        return $rows_affected;
    }

    public function getMatchData(Match $match)
    {
        try {
            $matchData = $this->whoscored->loadStatistics('match-centre2', array('id' => $match->getWsId()));
            $incidents = $this->whoscored->loadStatistics('live-player-stats', array('id' => $match->getWsId()));
        } catch (\Exception $e) {
            throw $e;
        }

        $stage = $match->getStage();
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();

        //$this->getSquads($homeTeam);
        //$this->getSquads($awayTeam);

        $statBuilder = new StatBuilder();
        $statBuilder->prepareEvents($matchData->events);

        foreach ($incidents[0][1][0] AS $event) {
            foreach([1,2] as $index) {
                foreach ($event[$index] AS $incident) {
                    $incidentType = $incident[2];
                    $info = ($incident[4]) ? $incident[4] : '';
                    $minute = $incident[5];
                    $player = $this->getPlayer($incident[6]);
                    $runningScore = ($incident[3]) ? $incident[3] : '';
                    if ($incident[7]) {
                        $participatingPlayer = $this->getPlayer($incident[7]);
                    } else {
                        $participatingPlayer = null;
                    }

                    $matchIncident = new MatchEvent();
                    $matchIncident->setPlayer($player);
                    $matchIncident->setInfo($info);
                    $matchIncident->setEventType($incidentType);
                    $matchIncident->setMatch($match);
                    $matchIncident->setParticipatingPlayer($participatingPlayer);
                    $matchIncident->setSide($index);
                    $matchIncident->setMinute($minute);
                    $matchIncident->setRunningScore($runningScore);

                    $this->em->persist($matchIncident);
                }
            }
        }

        foreach (['home', 'away'] as $side) {
            $team = ($side === 'home') ? $homeTeam : $awayTeam;
            $players = $matchData->{$side}->players;

            foreach ($players as $player) {
                if (($p = $this->getPlayer($player->playerId, $team)) == null) {
                    $p = new Player();

                    $p->setFirstName(null);
                    $p->setLastName(null);
                    $p->setKnownName($player->name);
                    $p->setAge($player->age);
                    $p->setWsId($player->playerId);
                    $p->setTeam($team);

                    $this->players[$player->playerId] = $p;

                    $this->em->persist($p);
                }
                $mps = new MatchPlayerStatistics();

                foreach ($statBuilder->filters as $filterIndex => $filter) {
                    $mps->{$filter->callback}($statBuilder->getFilterValue($filterIndex, $player->playerId));
                }

                $mps->setPlayer($p);
                $mps->setMatch($match);
                if (isset($player->isFirstEleven) && $player->isFirstEleven == true) {
                    $started = 1;
                } else {
                    $started = 0;
                }
                $mps->setGameStarted($started);
                $mps->setManOfTheMatch(($player->isManOfTheMatch) ? 1 : 0);
                $mps->setPositionText($player->position);
                $mps->setShirtNo(isset($player->shirtNo) ? $player->shirtNo : 0);
                $mps->setMinsPlayed($statBuilder->getMinutesPlayed($player->playerId, $started));

                if (isset($player->stats->ratings)) {
                    foreach ($player->stats->ratings as $rating) {
                        $mps->setRating($rating);
                    }
                } else {
                    $mps->setRating(0);
                }

                if ($p->getId() !== null) {
                    $sps = $this->em->getRepository('AppBundle:StagePlayerStatistics')->findOneBy(array('stage' => $stage, 'team' => $team, 'player' => $p));
                }

                if (!isset($sps)) {
                    $sps = new StagePlayerStatistics();
                    $sps->setPlayer($p);
                    $sps->setStage($stage);
                    $sps->setTeam($team);
                }

                $sps->addMatchStatistics($mps);

                $this->em->persist($sps);
                $this->em->persist($mps);

                unset($sps);
                unset($mps);
            }
        }

        $match->setStatus(1);
        $this->em->flush();
    }

    private function getPlayer($wsId, Team $team = null)
    {
        if (array_key_exists($wsId, $this->players)) {
            $player = $this->players[$wsId];
        } else {
            $player = $this->em->getRepository('AppBundle:Player')->findOneByWsId($wsId);
        }

        if ($player == null) {

            try {
                $data = $this->whoscored->getPlayerData($wsId);
            } catch (\Exception $e) {
                throw $e;
            }

            $player = new Player();

            $player->setFirstName($data->firstName);
            $player->setLastName($data->lastName);
            $player->setKnownName($data->knownName);
            $player->setAge($data->age);
            $player->setWsId($data->wsId);
        }

        if ($team !== null && $player->getTeam() !== $team) {
            $ret = $team;
            try {
                $teamId = $this->whoscored->getActiveTeam($wsId);
                $ret = $this->getTeam($teamId);
                $player->setTeam($ret);
            } catch (\Exception $e) {

            } finally {
                $player->setTeam($ret);
            }
        }

        $this->players[$wsId] = $player;

        $this->em->persist($player);

        return $player;
    }

    public function getSquads(Team $team)
    {
        $params = array(
            'age' => '',
            'ageComparisonType' => '',
            'appearances' => '',
            'appearancesComparisonType' => '',
            'category' => 'summary',
            'field' => 'Overall',
            'includeZeroValues' => 'true',
            'isCurrent' => 'true',
            'isMinApp' => 'false',
            'matchId' => '',
            'nationality' => '',
            'numberOfPlayersToPick' => '',
            'page' => '',
            'playerId' => '',
            'positionOptions' => '',
            'sotAscending' => '',
            'sortBy' => 'Rating',
            'stageId' => '',
            'statsAccumulationType' => 0,
            'subcategory' => 'all',
            'teamIds' => $team->getWsId(),
            'timeOfTheGameEnd' => '',
            'timeOfTheGameStart' => '',
            'tournamentOptions' => ''
        );

        try {
            $data = $this->whoscored->loadStatistics('player-stats', $params);
        } catch (\Exception $e) {
            throw $e;
        }

        if (empty($data->playerTableStats)) throw new \Exception('No player data found');

        foreach ($data->playerTableStats as $playerData) {
            $player = null;
            if (array_key_exists($playerData->playerId, $this->players)) {
                $player = $this->players[$playerData->playerId];
            } else {
                $player = $this->em->getRepository('AppBundle:Player')->findOneByWsId($playerData->playerId);
            }

            if ($player == null) {
                $player = new Player();

                $player->setFirstName($playerData->firstName);
                $player->setLastName($playerData->lastName);
                $player->setKnownName($playerData->name);
                $player->setAge($playerData->age);
                $player->setWsId($playerData->playerId);

                if ($playerData->isActive == false) {
                    $teamId = $this->whoscored->getActiveTeam($playerData->playerId);
                    try {
                        $ret = $this->getTeam($teamId);
                        $player->setTeam($ret);
                    } catch (\Exception $e) {

                    }

                } else {
                    $player->setTeam($team);
                }

                $this->em->persist($player);
            }

            $this->players[$playerData->playerId] = $player;
        }

        $this->em->flush();
    }

    public function getTeam($wsId)
    {

        $team = $this->em->getRepository('AppBundle:Team')->findOneByWsId($wsId);

        if ($team == null) {
            $params = array(
                'category' => 'summaryteam',
                'field' => 'Overall',
                'formation' => '',
                'isCurrent' => 'true',
                'numberOfTeamsToPick' => '',
                'page' => '',
                'sotAscending' => '',
                'sortBy' => 'Rating',
                'stageId' => '',
                'statsAccumulationType' => 0,
                'subcategory' => 'all',
                'teamIds' => $wsId,
                'timeOfTheGameEnd' => '',
                'timeOfTheGameStart' => '',
                'tournamentOptions' => ''
            );

            try {
                $teamData = $this->whoscored->loadStatistics('team-stats', $params);
            } catch (\Exception $e) {
                throw $e;
            }

            if (empty($teamData->teamTableStats)) throw new \Exception('No team data found');

            $team = new Team();
            $team->setWsId($teamData->teamTableStats[0]->teamId);
            $team->setName($teamData->teamTableStats[0]->teamName);

            $this->em->persist($team);
        }

        return $team;
    }

    public function getRegions()
    {
        $regions = json_decode(file_get_contents(__DIR__ . "/../Resources/regions.json"));

        foreach ( $regions as $region ) {
            $reg = new Region();
            $reg->setName($region->name);
            $reg->setWsId($region->id);
            $reg->setType($region->type);

            foreach ( $region->tournaments as $tournament ) {
                $tour = new Tournament();
                $tour->setRegion($reg);
                $tour->setWsId($tournament->id);
                $tour->setName($tournament->name);

                $this->em->persist($tour);
            }

            $this->em->persist($reg);
        }

        $this->em->flush();
    }

    public function getRegionTeams(Region $region)
    {
        $teams = $this->whoscored->loadStatistics('regionteams', array('id' => $region->getWsId()));

        foreach ( $teams as $team ) {
            if ($this->em->getRepository('AppBundle:Team')->findOneByWsId($team[0]) !== null) continue;
            $ret = new Team();
            $ret->setWsId($team[0]);
            $ret->setName($team[1]);
            $this->em->persist($ret);
            unset($ret);
        }

        $this->em->flush();
    }
}