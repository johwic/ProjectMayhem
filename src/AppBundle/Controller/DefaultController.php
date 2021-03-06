<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Stage;
use AppBundle\Utils\Scheduler;
use AppBundle\Utils\SubscriptionManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Region;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
//        $params = array(
//            'age' => '',
//            'ageComparisonType' => '',
//            'appearances' => '',
//            'appearancesComparisonType' => '',
//            'category' => 'summary',
//            'field' => 'Overall',
//            'includeZeroValues' => 'true',
//            'isCurrent' => 'true',
//            'isMinApp' => 'false',
//            'matchId' => '',
//            'nationality' => '',
//            'numberOfPlayersToPick' => '',
//            'page' => '',
//            'playerId' => 86570,
//            'positionOptions' => '',
//            'sotAscending' => '',
//            'sortBy' => 'Rating',
//            'stageId' => '',
//            'statsAccumulationType' => 0,
//            'subcategory' => 'all',
//            'teamIds' => '',
//            'timeOfTheGameEnd' => '',
//            'timeOfTheGameStart' => '',
//            'tournamentOptions' => ''
//        );
//        $result = $this->get('app.whoscored')->loadStatistics('player-stats', $params);
//        dump($result);
//        die();
        //$scheduler = new Scheduler();
        //dump($scheduler->schedule(959578));die();


        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/add-regions", name="add_regions")
     */
    public function addRegionsAction()
    {
        $sm = new SubscriptionManager($this->get('app.whoscored'), $this->getDoctrine()->getManager());
        $sm->getRegions();

        $this->addFlash('notice', 'Added regions.');

        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/regions", name="regions")
     */
    public function regionsAction(Request $request)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT r FROM AppBundle:Region r');

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('default/regions.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/regions/{id}/get-teams", name="region_teams")
     */
    public function getRegionTeamsAction(Region $region)
    {
        $sm = new SubscriptionManager($this->get('app.whoscored'), $this->getDoctrine()->getManager());
        $sm->getRegionTeams($region);

        $this->addFlash('notice', 'Downloaded teams from region ' . $region->getName());

        return $this->redirectToRoute('homepage');
    }
}