<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\SeasonType;
use AppBundle\Form\Type\StageType;
use AppBundle\Form\Type\FixtureType;
use AppBundle\Entity\Season;
use AppBundle\Entity\Stage;
use AppBundle\Utils\SubscriptionManager;

use DateTime;
use DateTimeZone;

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
     * @Route("/stages", name="stages")
     */
    public function stageAction()
    {
        $stages = $this->getDoctrine()->getManager()->getRepository('AppBundle:Stage')->findAll();

        return $this->render('subscription/stages.html.twig', array('stages' => $stages));
    }

    /**
     * @Route("/stages/{id}", name="stage-detail")
     */
    public function stageDetailAction(Stage $stage)
    {
        $this->get('app.whoscored')->getStageTeams($stage);

        return $this->render('subscription/stages.html.twig', array('stages' => $stages));
    }

    /**
     * @Route("/matches", name="matches")
     */
    public function matchAction()
    {
        $match = $this->getDoctrine()->getManager()->getRepository('AppBundle:Match')->findOneById(1);
        $sm = new SubscriptionManager($this->get('app.whoscored'), $this->getDoctrine()->getManager());
        $sm->getMatchData($match);

        return $this->render('default/index.html.twig', array());
    }

    /**
     * @Route("/stages/add", name="create_stage")
     */
    public function createStageAction(Request $request)
    {
        $stage = new Stage();
        $form = $this->createForm(new StageType($this->get('app.whoscored')), $stage);
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($stage->getName() == '') {
                $stage->setName($stage->getTournament()->getName() . ' ' . $stage->getSeason()->getYear());
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();

            $this->addFlash('notice', 'Stage ' . $stage->getName() . ' with WhoScored ID ' . $stage->getWsId() . ' saved.');

            return $this->redirectToRoute('homepage');
        }

        return $this->render('subscription/create_stage.html.twig', array('form' => $form->createView()));
    }
}