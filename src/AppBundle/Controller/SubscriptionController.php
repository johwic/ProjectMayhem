<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Subscription;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\SeasonType;
use AppBundle\Form\Type\StageType;
use AppBundle\Form\Type\FixtureType;
use AppBundle\Entity\Season;
use AppBundle\Entity\Match;
use AppBundle\Entity\Stage;
use AppBundle\Utils\SubscriptionManager;
use AppBundle\Utils\Scheduler;

class SubscriptionController extends Controller
{
    /**
     * @Route("/stages/get-fixtures", name="download-fixtures")
     *
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(FixtureType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $stage = $form->get('stage')->getData();

            $sm = new SubscriptionManager($this->get('app.whoscored'), $this->getDoctrine()->getManager());

            $start = strtotime($form->get('startweek')->getData());
            $end = strtotime($form->get('endweek')->getData());

            $d = $start;
            $count = 0;
            while ($d <= $end) {
                try {
                    $result = $sm->getFixtures($stage, date('o\WW', $d));
                    $count += $result;
                } catch (\Exception  $e) {
                    dump($e);
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
        $form = $this->createForm(SeasonType::class, $season);
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

    /**
     * @Route("/stages/{id}/get-data", name="download_match_data")
     */
    public function downloadMatch(Stage $stage)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT m FROM AppBundle:Match m WHERE m.time < :time AND m.stage = :stage AND m.status = 0');
        $query->setParameters(array('time' => time() - 3600*5, 'stage' => $stage->getId()));

        $results = $query->getResult();
        //dump($results);die();
        $scheduler = new Scheduler();

        foreach ($results as $match) {
            $scheduler->schedule($match->getWsId());

            $match->setStatus(2);
        }

        $this->getDoctrine()->getManager()->flush();
        $this->addFlash('notice', 'Downloaded match data for match with WhoScored ID ' . count($results));

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/subscriptions", name="subscriptions")
     */
    public function manageSubscriptions()
    {
        $subscriptions = $this->getDoctrine()->getManager()->getRepository('AppBundle:Subscription')->findAll();
        $stages= $this->getDoctrine()->getManager()->getRepository('AppBundle:Stage')->findAll();

        return $this->render('subscription/subscriptions.html.twig', array('subscriptions' => $subscriptions, 'stages' => $stages));
    }

    /**
     * @Route("/add-subscription", name="add_subscription")
     */
    public function addSubscription(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $stage = $em->getRepository('AppBundle:Stage')->findOneById($request->get('stage'));

        if ($stage != null) {
            $sub = new Subscription();
            $sub->setStage($stage);
            $sub->setSubscribed(true);
            $em->persist($sub);
            $em->flush();
        }

        $this->addFlash('notice', 'Subscribed to stage ' . $stage);

        return $this->redirectToRoute('subscriptions');
    }

    /**
     * @Route("/{id}/update-db", name="update-db")
     */
    public function updateDb(Stage $stage)
    {
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT m FROM AppBundle:Match m WHERE m.status = 2 AND m.stage = :stage')->setParameter('stage', $stage->getId());
        $results = $query->getResult();

        foreach ($results as $match) {
            $sm = new SubscriptionManager($this->get('app.whoscored'), $this->get('doctrine.orm.entity_manager'));
            $sm->getMatchData($match);
        }

        $this->addFlash('notice', 'Flushed match data for stage ' . $stage->getName() . '. ' . count($results) . ' matches flushed.');

        return $this->redirectToRoute('homepage');
    }
}