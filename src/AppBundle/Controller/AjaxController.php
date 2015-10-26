<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Entity\Tournament;
use AppBundle\Entity\Region;

class AjaxController extends Controller
{
    /**
     * @Route("/find-seasons/{id}", name="find-seasons")
     */
    public function findSeasonAction($id)
    {
        $ret = $this->get('app.whoscored')->getSeasonIds($id);
        $content = array('seasons' => $ret);

        return new JsonResponse($content);
    }

    /**
     * @Route("/find-stages/{id}", name="find-stages")
     */
    public function findStageAction($id)
    {
        $ret = $this->get('app.whoscored')->getStageIds($id);
        $content = array('stages' => $ret);

        return new JsonResponse($content);
    }

    /**
     * @Route("/get-tournaments/{id}", name="get-tournaments")
     */
    public function getTournamentAction(Region $region)
    {
        $tournaments = $region->getTournaments();
        $ret = array();
        foreach($tournaments as $tournament) {
            $ret[] = array('id' => $tournament->getId(), 'name' => $tournament->getName());
        }
        $content = array('tournaments' => $ret);

        return new JsonResponse($content);
    }

    /**
     * @Route("/get-seasons/{id}", name="get-seasons")
     */
    public function getSeasonAction(Tournament $tournament)
    {
        $seasons = $this->getDoctrine()->getManager()->getRepository('AppBundle:Season')->findBy(array('tournament' => $tournament));
        $ret = array();
        foreach($seasons as $season) {
            $ret[] = array('id' => $season->getId(), 'name' => $season->getYear());
        }
        $content = array('seasons' => $ret);

        return new JsonResponse($content);
    }
}