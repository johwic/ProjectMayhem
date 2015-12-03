<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\Type\StageType;
use AppBundle\Entity\Stage;

class StageController extends Controller
{
    /**
     * @Route("/stages", name="stages")
     */
    public function stageAction()
    {
        $stages = $this->getDoctrine()->getManager()->getRepository('AppBundle:Stage')->findAll();

        return $this->render('stage/stages.html.twig', array('stages' => $stages));
    }

    /**
     * @Route("/stages/{id}/details", name="stage-detail")
     */
    public function stageDetailAction(Stage $stage)
    {
        $matches = $this->get('doctrine.orm.entity_manager')->getRepository('AppBundle:Match')->findBy(array('stage' => $stage), array('time' => 'DESC'));

        return $this->render('stage/stage_details.html.twig', array('matches' => $matches));
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

        return $this->render('stage/create_stage.html.twig', array('form' => $form->createView()));
    }
}
