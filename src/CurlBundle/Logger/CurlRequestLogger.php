<?php

namespace CurlBundle\Logger;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Stopwatch\Stopwatch;

class CurlRequestLogger
{
    /**
     * @var array $calls Executed API calls.
     */
    public $calls = array();
    public $start = null;
    public $currentCall = 0;

    private $logger;
    private $stopwatch;


    /**
     * Constructor.
     *
     * @param LoggerInterface $logger    A LoggerInterface instance
     * @param Stopwatch       $stopwatch A Stopwatch instance
     */
    public function __construct(LoggerInterface $logger = null, Stopwatch $stopwatch = null)
    {
        $this->logger = $logger;
        $this->stopwatch = $stopwatch;
    }

    public function startRequest(Request $request)
    {
        $this->stopwatch->start('curl_request');
        $this->calls[++$this->currentCall] = array(
            'method' => $request->getMethod(),
            'url' => $request->getUri(),
            'request' => $request
        );
    }

    public function stopRequest(Response $response)
    {
        $event = $this->stopwatch->stop('curl_request');
        $this->calls[$this->currentCall] += array(
            'statusCode' => $response->getStatusCode(),
            'time' => $event->getDuration(),
            'response' => $response
        );

        $type = $this->calls[$this->currentCall]['method'];
        $url = $this->calls[$this->currentCall]['url'];
        $status = $this->calls[$this->currentCall]['statusCode'];
        $responseDataLength = strlen($response->getContent());
        $executionMS = $event->getDuration();

        $this->logger->debug("API call \"$type\" requested \"$url\" that returned \"$status\" in $executionMS ms sending $responseDataLength bytes");
    }
}