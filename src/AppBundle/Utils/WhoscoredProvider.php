<?php

namespace AppBundle\Utils;

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

use CurlBundle\HttpKernel\RemoteHttpKernel;

class WhoscoredProvider
{
    private $em;
    private $cache;
    private $timer;
    private $remoteKernel;

    public function __construct(EntityManager $em, FilesystemCache $cache, RemoteHttpKernel $kernel = null) {
        $this->em = $em;
        $this->cache = $cache;
        $this->timer = 0;
        $this->remoteKernel = $kernel;
    }

    public function getSeasonIds($id)
    {
        $tournament = $this->em->getRepository('AppBundle:Tournament')->find($id);

        $t = $tournament->getWsId();
        $r = $tournament->getRegion()->getWsId();
        $cache_key = 'season_r' . $r . '_t' . $t;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $req = Request::create(Url::get('season', array('r' => $r, 't' => $t)), 'GET');

            try {
                $response = $this->remoteKernel->handle($req);
            } catch (\Exception $e) {
                throw $e;
            }

            $code = $response->getStatusCode();

            if ($code !== 200) throw new \Exception($response->getContent(), $code);

            $crawler = new Crawler($response->getContent());
            $content = $crawler->filter('#seasons > option')->each(function (Crawler $node, $i) {
                preg_match('/Seasons\/(\d+)/', $node->attr('value'), $matches);
                return array('wsid' => $matches[1], 'name' => $node->text());
            });

            $this->cache->save($cache_key, $content, 3600*24);
        }

        return $content;
    }

    public function getStageIds($seasonId)
    {
        $season = $this->em->getRepository('AppBundle:Season')->find($seasonId);
        $s = $season->getWsId();
        $t = $season->getTournament()->getWsId();
        $r = $season->getTournament()->getRegion()->getWsId();
        $cache_key = 'stage_r' . $r . '_t' . $t . '_s' . $s;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $req = Request::create(Url::get('stages', array('r' => $r, 't' => $t, 's' => $s)), 'GET');

            try {
                $response = $this->remoteKernel->handle($req);
            } catch (\Exception $e) {
                throw $e;
            }

            $code = $response->getStatusCode();

            if ($code !== 200) throw new \Exception($response->getContent(), $code);

            $crawler = new Crawler($response->getContent());
            $content = $crawler->filter('#stages > option')->each(function (Crawler $node, $i) {
                preg_match('/Stages\/(\d+)/', $node->attr('value'), $matches);
                return array('wsid' => $matches[1], 'name' => $node->text());
            });

            if ($content == null) {
                $id = $crawler->filter('div[id^=tournament-tables-]')->attr('id');
                preg_match('/tournament-tables-(\d+)/', $id, $matches);
                $content = array(array('wsid' => $matches[1], 'name' => ''));
            }

            $this->cache->save($cache_key, $content, 3600*24);
        }

        return $content;
    }

    public function getActiveTeam($playerId)
    {
        $cache_key = 'activeteam_' . $playerId;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $req = Request::create(Url::get('player', array('p' => $playerId)), 'GET');

            try {
                $response = $this->remoteKernel->handle($req);
            } catch (\Exception $e) {
                throw $e;
            }

            $code = $response->getStatusCode();
            $content = $response->getContent();

            if ($code !== 200) throw new \Exception($content, $code);

            $crawler = new Crawler($content);
            $node = $crawler->filter('dd > a[class="team-link"]');
            if (empty($node->attr('href'))) throw new \Exception('Team id not found');

            preg_match('/Teams\/(\d+)/', $node->attr('href'), $matches);
            $content = $matches[1];

            $this->cache->save($cache_key, $content, 3600*24*7);
        }

        if (!ctype_digit(strval($content))) throw new \Exception('No integer');

        return $content;
    }

    public function getPlayerData($playerId)
    {
        $cache_key = 'player_' . $playerId;
        $code = 201;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $req = Request::create(Url::get('player', array('p' => $playerId)), 'GET');

            try {
                $response = $this->remoteKernel->handle($req);
            } catch (\Exception $e) {
                throw $e;
            }

            $code = $response->getStatusCode();
            $html = $response->getContent();

            if ($code !== 200) throw new \Exception($html, $code);

            $crawler = new Crawler($html);

            $node = $crawler->filterXPath('//script[contains(., "Model-Last-Mode")]')->text();
            preg_match("/'Model-Last-Mode': '(.*?)' }/", $node, $matches);
            $modelLastMode = $matches[1];

            $data = $crawler->filterXPath('//script[contains(., "var currentTeamId")]')->text();
            preg_match('/var currentTeamId = (\d*?);/', $data, $teamId);
            $teamId = $teamId[1];

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
                'playerId' => $playerId,
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

            try {
                $data = $this->loadStatistics('player-stats', $params, array('Model-Last-Mode' => $modelLastMode, 'Referer' => $req->getUri()));
            } catch (\Exception $e) {
                throw $e;
            }

            $player = array();
            if (empty($data->playerTableStats)) {
                $info = $crawler->filterXPath('//div[@id="player-profile"]//dl/dt')->each(function (Crawler $node, $i) {
                    return array('key' => $node->text(), 'value' => trim($node->siblings()->text()));
                });

                $name = '';
                $age = 0;
                foreach ($info as $item) {
                    if ($item['key'] == 'Name:') {
                        $name = $item['value'];
                    }
                }

                $player['firstName'] = null;
                $player['lastName'] = null;
                $player['knownName'] = $name;
                $player['age'] = $age;
                $player['wsId'] = $playerId;
                $player['teamId'] = $teamId;
            } else {
                $player['firstName'] = $data->playerTableStats[0]->firstName;
                $player['lastName'] = $data->playerTableStats[0]->lastName;
                $player['knownName'] = $data->playerTableStats[0]->name;
                $player['age'] = $data->playerTableStats[0]->age;
                $player['wsId'] = $playerId;
                $player['teamId'] = $teamId;
            }

            $content = json_encode($player);
            $this->cache->save($cache_key, $content, 3600*24*7);
        }

        $content = json_decode($content);

        if (json_last_error() !== JSON_ERROR_NONE || $content == null)  throw new \Exception('Json error or empty object', $code);

        return $content;
    }

    /**
     * @param String $key Url key
     * @param array $param Array of parameters
     * @param array $headers Additional headers to send
     *
     * @return Object $content
     *
     * @throws \Exception
     */
    public function loadStatistics($key, $param, $headers = array())
    {
        ksort($param);
        $cache_key = $key;
        foreach ($param as $val) {
            if (!empty($val)) $cache_key .= '_' . $val;
        }
        $code = 201;

        if ($key == 'match-centre2' || $key == 'live-player-stats') {
            $id = $param['id'];
            $ret = ($key == 'match-centre2') ? 'matchCentreData' : 'matchStats';
            $content = file_get_contents('C:\\UniServerZ\\www\\whoscored\\data\\' . $id . '\\' . $ret . '.json');

            $content = json_decode($content);

            if (json_last_error() !== JSON_ERROR_NONE || $content == null)  throw new \Exception('Json error or empty object', $code);

            return $content;
        }

        if (false === ($content = $this->cache->fetch($cache_key))) {

            $req = Request::create(Url::get($key, $param), 'GET');
            $req->headers->add(array_merge(array(
                'Host' => 'www.whoscored.com',
                'Accept' => 'text/plain, */*; q=0.01',
                'Accept-Language' => 'sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3',
                'X-Requested-With' => 'XMLHttpRequest',
                'Connection' => 'keep-alive',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0'
            ), $headers));

            try {
                if ((microtime(true) - $this->timer) < 2) sleep(1);
                $response = $this->remoteKernel->handle($req);
            } catch (\Exception $e) {
                throw $e;
            }

            $this->timer = microtime(true);
            $code = $response->getStatusCode();
            $content = $response->getContent();

            if ($code !== 200) throw new \Exception($content, $code);

            $this->cache->save($cache_key, $content);
        }
        
        if (Url::isArray($key)) {
            $content = str_replace(array(',,', ',,', '"', "\'", ",]"), array(',null,', ',null,', '\"', "'", ",null]"), $content);
            $content = preg_replace("/'(.*?)'(\s*[,\]])/", '"$1"$2', $content);
        }

        $content = json_decode($content);

        if (json_last_error() !== JSON_ERROR_NONE || $content == null)  throw new \Exception('Json error or empty object', $code);

        return $content;
    }
}