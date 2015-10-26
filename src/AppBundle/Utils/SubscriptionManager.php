<?php

namespace AppBundle\Utils;

use AppBundle\Entity\MatchPlayerStatistics;
use AppBundle\Entity\Player;
use AppBundle\Entity\Stage;
use AppBundle\Entity\Match;
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

    public function __construct(WhoscoredProvider $whoscored, EntityManager $em)
    {
        $this->whoscored = $whoscored;
        $this->em = $em;
    }

    public function getFixtures(Stage $stage, $week)
    {
        $fixtures = $this->whoscored->loadStatistics('stagefixtures', array('stageId' => $stage->getWsId(), 'd' => $week, 'isAggregate' => false));
        $rows_affected = 0;

        foreach ($fixtures as $fixture) {
            $matchId = $fixture[0];
            $count = $this->em->createQuery('SELECT COUNT(m) FROM AppBundle:Match m WHERE m.wsId = :id')->setParameter(':id', $matchId)->getSingleScalarResult();
            if ($count == 1) continue;

            $homeTeam = $this->em->getRepository('AppBundle:Team')->findOneByWsId($fixture[4]);
            $awayTeam = $this->em->getRepository('AppBundle:Team')->findOneByWsId($fixture[7]);

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
        $rawMatchData = $this->whoscored->loadStatistics('match-centre2', array('id' => $match->getWsId()));
        $matchData = json_decode($rawMatchData);
        $stage = $match->getStage();

        $statBuilder = new StatBuilder();
        foreach ($matchData->events as $event) {
            $statBuilder->add($event);
        }

        $playersConcat = array($matchData->home->players, $matchData->away->players);
        $teams = array($match->getHomeTeam(), $match->getAwayTeam());
        foreach ($playersConcat as $index => $players) {
            foreach ($players as $player) {
                $p = $this->getPlayer($player->playerId, $teams[$index]);
                $pms = new MatchPlayerStatistics();

                foreach ($statBuilder->filters as $filterIndex => $filter) {
                    $pms->{$statBuilder->filters[$filterIndex]->callback}($statBuilder->getFilterValue($filterIndex, $player->playerId));
                }

                $pms->setPlayer($p);
                $pms->setMatch($match);
                if (isset($player->isFirstEleven) && $player->isFirstEleven == true) {
                    $started = 1;
                } else {
                    $started = 0;
                }
                $pms->setGameStarted($started);
                $pms->setManOfTheMatch(($player->isManOfTheMatch) ? 1 : 0);
                $pms->setPositionText($player->position);
                $pms->setShirtNo($player->shirtNo);
                $pms->setMinsPlayed($statBuilder->getMinutesPlayed($player->playerId, $started));

                if (isset($player->stats->ratings)) {
                    foreach ($player->stats->ratings as $rating) {
                        $pms->setRating($rating);
                    }
                } else {
                    $pms->setRating(0);
                }

                if ($p->getId() !== null) {
                    $sps = $this->em->createQuery('SELECT s FROM AppBundle:StagePlayerStatistics s WHERE s.stage = :stage AND s.player = :player AND s.team = :team')
                        ->setParameters(array('stage' => $stage, 'player' => $p, 'team' => $teams[$index]))
                        ->getSingleResult();
                } else {
                    $sps = new StagePlayerStatistics();
                    $sps->setPlayer($p);
                    $sps->setStage($stage);
                    $sps->setTeam($teams[$index]);
                }

                $sps->addMatchStatistics($pms);

                $this->em->persist($sps);
                $this->em->persist($pms);
            }
        }

        $this->em->flush();
    }

    public function getPlayer($wsId, Team $team)
    {
        $player = $this->em->getRepository('AppBundle:Player')->findOneByWsId($wsId);

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
            'playerId' => $wsId,
            'positionOptions' => '',
            'sotAscending' => '',
            'sortBy' => 'Rating',
            'stageId' => '',
            'statsAccumulationType' => 0,
            'subcategory' => 'all',
            'teamIds' => '',
            'timeOfTheGameEnd' => '',
            'timeOfTheGameStart' => '',
            'tournamentOptions' => ''
        );

        $playerData = $this->whoscored->loadStatistics('player-stats', $params);

        $data = json_decode($playerData);

        if ($data == null) {
            sleep(1);
            $playerData = $this->whoscored->loadStatistics('player-stats', $params);

            $data = json_decode($playerData);
        }

        if ($player == null) {
            $player = new Player();

            $player->setFirstName($data->playerTableStats[0]->firstName);
            $player->setLastName($data->playerTableStats[0]->lastName);
            $player->setKnownName($data->playerTableStats[0]->name);
            $player->setAge($data->playerTableStats[0]->age);
            $player->setWsId($wsId);
        }

        //if ($data->playerTableStats[0]->isActive) {
            $player->setTeam($team);
        //}

        $this->em->persist($player);

        return $player;
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

            $teamData = json_decode($this->whoscored->loadStatistics('team-stats', $params));

            $team = new Team();
            $team->setWsId($teamData->teamTableStats[0]->teamId);
            $team->setName($teamData->teamTableStats[0]->teamName);
            $this->em->persist($team);
        }
        dump($team);
        die();
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
            $ret = new Team();
            $ret->setWsId($team[0]);
            $ret->setName($team[1]);
            $this->em->persist($ret);
            unset($ret);
        }

        $this->em->flush();
    }
}