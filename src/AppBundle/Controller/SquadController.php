<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SquadController extends Controller
{
    /**
     * @Route("/update-squad/{id}", name="squads")
     */
    public function teamAction(Team $team)
    {
        $params = array('teamId' => $team->getId(),
            'category' => 'summary',
            'field' => 'Overall',
            'subcategory' => 'all',
            'statsAccumulationType' => 0,
            'includeZeroValues' => 'true',
            'isCurrent' => 'true');

        $playerData = $this->get('app.whoscored')->loadStatistics('player-stats', $params);
        return $this->render('', array());
    }
}
