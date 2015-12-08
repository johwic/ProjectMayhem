<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Form\Type\SearchPlayerType;

class BetController extends Controller
{
    /**
     * @Route("/bets", name="betting")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createForm(SearchPlayerType::class);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $q = $form->get('knownName')->getData();
            $query = $em->createQuery('SELECT p FROM AppBundle:Player p WHERE p.knownName LIKE :name')->setMaxResults(10);
            $query->setParameter('name','%' . $q . '%');

            $result = $query->getResult();
            $status = (count($result) > 0) ? 'success' : 'no_result';

            return new JsonResponse(array('status' => $status, 'html' => $this->renderView('bet/search_row.html.twig', array('players' => $result))));
        } else if ($form->isSubmitted()) {
            return new JsonResponse(array('status' => 'error', 'html' => '<tr><td>' . (string) $form->getErrors(true, false) . '</td></tr>'));
        }

        return $this->render('bet/search_index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function playerAction(Request $request)
    {
        $query = $this->getDoctrine()->getManager()->createQuery('SELECT p FROM AppBundle:StagePlayerStatistics p WHERE p.goalsScored > 5 AND s.stage = 1');

        $results = $query->getResult();
    }
}
