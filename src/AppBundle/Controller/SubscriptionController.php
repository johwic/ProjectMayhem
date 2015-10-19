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

            return new RedirectResponse('');
        }

        if ($request->isXmlHttpRequest()) {
            return new JsonResponse(array('html' => $this->renderView('subscription/tournament_select.html.twig', array('form' => $form->get('tournament')->createView()))));
        }

        return $this->render('subscription/create_season.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/find-seasons/{id}", name="find-seasons")
     */
    public function findSeasonAction(Tournament $tournament)
    {
        $tId = $tournament->getWsId();
        $rId = $tournament->getRegion()->getWsId();

        $req = Request::create('http://www.whoscored.com/Regions/' . $rId . '/Tournaments/' . $tId . '/', 'GET');
        $remoteKernel = new RemoteHttpKernel();
        $response = $remoteKernel->handle($req);

        $crawler = new Crawler($response->getContent());
        $content = array('seasons' => $crawler->filter('#seasons > option')->each(function (Crawler $node, $i) {
            preg_match('/Seasons\/(\d+)/', $node->attr('value'), $matches);
            return array('wsid' => (int) $matches[1], 'name' => $node->text());
        }));

        return new JsonResponse($content);
    }
}