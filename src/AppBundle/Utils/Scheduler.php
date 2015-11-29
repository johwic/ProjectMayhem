<?php

namespace AppBundle\Utils;

use Zeroem\CurlBundle\HttpKernel\RemoteHttpKernel;
use Symfony\Component\HttpFoundation\Request;

class Scheduler
{
    public function schedule($id)
    {
        $req = Request::create('http://localhost:6800/schedule.json', 'POST', array(), array(), array(), array(), http_build_query(array('project' => 'whoscored', 'spider' => 'match', 'match_id' => $id)));
        $remoteKernel = new RemoteHttpKernel();

        return $remoteKernel->handle($req);
    }
}