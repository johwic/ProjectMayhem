<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DomCrawler\Crawler;

use Zeroem\CurlBundle\HttpKernel\RemoteHttpKernel;

use AppBundle\Form\Type\SeasonType;
use AppBundle\Entity\Season;
use AppBundle\Entity\Tournament;

class SubscriptionController extends Controller
{
    /**
     * @Route("/subscriptions", name="subscription")
     */
    public function indexAction(Request $request)
    {
        $content = $this->get('app.whoscored')->getStageIds(4);

        return new JsonResponse(array('stages' => $content));
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

            return new RedirectResponse('/');
        }

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(array('html' => $this->renderView('subscription/tournament_select.html.twig', array('form' => $form->get('tournament')->createView()))));
        }

        return $this->render('subscription/create_season.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/find-seasons/{id}", name="find-seasons")
     */
    public function findSeasonAction($id)
    {
        $ret = $this->get('app.whoscored')->getSeasonIds($id);
        $content = array('seasons' => $ret);

        return new JsonResponse($content);
    }
}