<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\SeasonType;
use AppBundle\Form\Type\StageType;
use AppBundle\Form\Type\FixtureType;
use AppBundle\Entity\Season;
use AppBundle\Entity\Match;
use AppBundle\Utils\SubscriptionManager;

class SubscriptionController extends Controller
{
    /**
     * @Route("/stages/get-fixtures", name="download-fixtures")
     *
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(new FixtureType());
        $form->handleRequest($request);
        if ($form->isValid()) {
            $stage = $form->get('stage')->getData();

            $sm = new SubscriptionManager($this->get('app.whoscored'), $this->getDoctrine()->getManager());

            $start = strtotime($form->get('startweek')->getData());
            $end = strtotime($form->get('endweek')->getData());

            $d = $start;
            $count = 0;
            while ($d <= $end) {
                $result = $sm->getFixtures($stage, date('o\WW', $d));
                if ($result[0] == 200) {
                    $count += $result[1];
                } else {

                }

                $d += 60*60*24*7;
            }

            $this->addFlash('notice', 'Downloaded fixtures from Stage ' . $stage->getName() . ' with WhoScored ID ' . $stage->getWsId() . '. ' . $count . ' matches saved.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('subscription/add_fixtures.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/seasons", name="seasons")
     */
    public function createAction(Request $request)
    {
        $season = new Season();
        $form = $this->createForm(new SeasonType($this->get('app.whoscored')), $season);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($season);
            $em->flush();

            $this->addFlash('notice', 'Season ' . $season->getYear() . ' with WhoScored ID ' . $season->getWsId() . ' saved.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('subscription/create_season.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/matches/{id}/get-data", name="get_match_data")
     */
    public function matchAction(Match $match)
    {
        $sm = new SubscriptionManager($this->get('app.whoscored'), $this->get('doctrine.orm.entity_manager'));
        $sm->getMatchData($match);

        $this->addFlash('notice', 'Downloaded match data for match with WhoScored ID ' . $match->getWsId());

        return $this->redirectToRoute('homepage');
    }
}