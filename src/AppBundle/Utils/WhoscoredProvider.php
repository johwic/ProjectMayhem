<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

use Zeroem\CurlBundle\HttpKernel\RemoteHttpKernel;

class WhoscoredProvider
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getSeasonIds($id)
    {
        $tournament = $this->em->getRepository('AppBundle:Tournament')->find($id);

        $t = $tournament->getWsId();
        $r = $tournament->getRegion()->getWsId();

        $req = Request::create(Url::get('season', array('r' => $r, 't' => $t)), 'GET');
        $remoteKernel = new RemoteHttpKernel();
        $response = $remoteKernel->handle($req);

        $crawler = new Crawler($response->getContent());
        $content = $crawler->filter('#seasons > option')->each(function (Crawler $node, $i) {
            preg_match('/Seasons\/(\d+)/', $node->attr('value'), $matches);
            return array('wsid' => $matches[1], 'name' => $node->text());
        });

        return $content;
    }

    public function getStageIds($seasonId)
    {
        $season = $this->em->getRepository('AppBundle:Season')->find($seasonId);
        $s = $season->getWsId();
        $t = $season->getTournament()->getWsId();
        $r = $season->getTournament()->getRegion()->getWsId();

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

        return $content;
    }
}