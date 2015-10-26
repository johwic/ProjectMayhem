<?php

namespace AppBundle\Utils;

use AppBundle\Entity\Stage;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

use Zeroem\CurlBundle\Curl\RequestGenerator;
use Zeroem\CurlBundle\HttpKernel\RemoteHttpKernel;

class WhoscoredProvider
{
    private $em;
    private $cache;

    public function __construct(EntityManager $em, FilesystemCache $cache) {
        $this->em = $em;
        $this->cache = $cache;
        $this->cache->setNamespace('whoscored.cache');
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
            $response = $remoteKernel->handle($req);

            $crawler = new Crawler($response->getContent());
            $content = $crawler->filter('#seasons > option')->each(function (Crawler $node, $i) {
                preg_match('/Seasons\/(\d+)/', $node->attr('value'), $matches);
                return array('wsid' => $matches[1], 'name' => $node->text());
            });

            if ($response->getStatusCode() == 200) $this->cache->save($cache_key, $content, 3600*24);
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
            $response = $remoteKernel->handle($req);

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

            if ($response->getStatusCode() == 200) $this->cache->save($cache_key, $content, 3600*24);
        }
        return $content;
    }

    public function getStageTeams(Stage $stage)
    {

    }

    public function loadStatistics($key, $param, $returnCode = false)
    {
        $cache_key = $key . '?' . http_build_query($param);
        $code = 200;

        if (false === ($content = $this->cache->fetch($cache_key))) {
            $generator = new RequestGenerator(array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0',
                CURLOPT_ENCODING => 'gzip, deflate',
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_FAILONERROR => true,
                CURLOPT_REFERER => 'http://www.whoscored.com'
            ));

            $req = Request::create(Url::get($key, $param), 'GET');
            $req->headers->add(array(
                'Host' => 'www.whoscored.com',
                'Accept' => 'text/plain, *//*; q=0.01',
                'Accept-Language' => 'en-US,en;q=0.5',
                'X-Requested-With' => 'XMLHttpRequest',
                'Connection' => 'keep-alive',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0'
            ));
            $remoteKernel = new RemoteHttpKernel($generator);
            $response = $remoteKernel->handle($req);
            $code = $response->getStatusCode();
            $content = $response->getContent();

            if ($response->getStatusCode() == 200) $this->cache->save($cache_key, $content);
        }

        if ( $returnCode ) return array('content' => $content, 'status_code' => $code);

        return $content;
    }
}