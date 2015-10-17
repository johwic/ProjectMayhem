<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Player;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use AppBundle\Form\Type\SearchPlayerType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $form = $this->createForm(new SearchPlayerType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $q = $form->get('knownName')->getData();
            $query = $em->createQuery('SELECT p FROM AppBundle:Player p WHERE p.knownName LIKE :name')->setMaxResults(10);
            $query->setParameter('name','%' . $q . '%');

            $result = $query->getResult();
            $status = (count($result) > 0) ? 'success' : 'no_result';

            return new JsonResponse(array('status' => $status, 'html' => $this->renderView('AppBundle::search_row.html.twig', array('players' => $result))));
        } else if ($form->isSubmitted()) {
            return new JsonResponse(array('status' => 'error', 'html' => '<tr><td>' . (string) $form->getErrors(true, false) . '</td></tr>'));
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
