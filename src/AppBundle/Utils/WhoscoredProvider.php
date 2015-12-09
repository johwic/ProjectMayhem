<?php

namespace AppBundle\Utils;

use CurlBundle\Logger\CurlRequestLogger;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

use Teknoo\Curl\RequestGenerator;
use CurlBundle\HttpKernel\RemoteHttpKernel;

class WhoscoredProvider
{
    private $em;
    private $cache;
    private $timer;

    public function __construct(EntityManager $em, FilesystemCache $cache) {
        $this->em = $em;
        $this->cache = $cache;
        $this->timer = 0;
    }

    public function getSeasonIds($id)
    {
        $tournament = $this->em->getRepository('AppBundle:Tournament')->find($id);

        $t = $tournament->getWsId();
        $r = $tournament->getRegion()->getWsId();
        $cache_key = 'season_r' . $r . '_t' . $t;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $req = Request::create(Url::get('season', array('r' => $r, 't' => $t)), 'GET');
            $remoteKernel = new RemoteHttpKernel();
            try {
                $response = $remoteKernel->handle($req);
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
            $remoteKernel = new RemoteHttpKernel();

            try {
                $response = $remoteKernel->handle($req);
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

            $remoteKernel = new RemoteHttpKernel();
            try {
                $response = $remoteKernel->handle($req);
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

    /**
     * @param String $key Url key
     * @param Array $param Array of parameters
     *
     * @return Object $content
     *
     * @throws \Exception
     */
    public function loadStatistics($key, $param)
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
            $req->headers->add(array(
                'Host' => 'www.whoscored.com',
                'Accept' => 'text/plain, */*; q=0.01',
                'Accept-Language' => 'sv-SE,sv;q=0.8,en-US;q=0.5,en;q=0.3',
                'X-Requested-With' => 'XMLHttpRequest',
                'Connection' => 'keep-alive',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0'
            ));

            $remoteKernel = new RemoteHttpKernel(array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0',
                CURLOPT_ENCODING => 'gzip, deflate',
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_FAILONERROR => true,
                CURLOPT_REFERER => 'http://www.whoscored.com'
            ), null, null);

            try {
                if ((microtime(true) - $this->timer) < 2) sleep(1);
                $response = $remoteKernel->handle($req);
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