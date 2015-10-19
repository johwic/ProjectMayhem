<?php

namespace AppBundle\Utils;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DomCrawler\Crawler;

use Zeroem\CurlBundle\HttpKernel\RemoteHttpKernel;

use AppBundle\Entity\Tournament;

class WhoscoredProvider
{
    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getSeasonIds($id)
    {
        $tournament = $this->em->getRepository('AppBundle:Tournament')->find($id);

        $tId = $tournament->getWsId();
        $rId = $tournament->getRegion()->getWsId();

        $req = Request::create('http://www.whoscored.com/Regions/' . $rId . '/Tournaments/' . $tId . '/', 'GET');
        $remoteKernel = new RemoteHttpKernel();
        $response = $remoteKernel->handle($req);

        $crawler = new Crawler($response->getContent());
        $content = $crawler->filter('#seasons > option')->each(function (Crawler $node, $i) {
            preg_match('/Seasons\/(\d+)/', $node->attr('value'), $matches);
            return array("$matches[1]" => $node->text());
        });

        return $content;
    }
}