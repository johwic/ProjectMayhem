<?php

namespace CurlBundle\DataCollector;


use CurlBundle\Logger\CurlRequestLogger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

class CurlRequestCollector extends DataCollector
{

    private $logger;

    /**
     * Class constructor
     *
     * @param CurlRequestLogger $logger Logger object
     */
    public function __construct(CurlRequestLogger $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * Collects data for the given Request and Response.
     *
     * @param Request $request A Request instance
     * @param Response $response A Response instance
     * @param \Exception $exception An Exception instance
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data = array(
            'calls'        => null !== $this->logger ? $this->logger->calls : array(),
        );
    }

    /**
     * Method counts amount of HTTP statuses, which is not equals to "200 OK"
     *
     * @return number
     */
    public function getReturnedErrorCount()
    {
        $errors = 0;
        foreach ($this->data['calls'] as $call) {
            $errors += ($call['statusCode'] != 200) ? 1 : 0;
        }

        return $errors;
    }

    /**
     * Method returns amount of logged API calls
     *
     * @return number
     */
    public function getCallCount()
    {
        return count($this->data['calls']);
    }

    /**
     * Method returns all logged API call objects
     *
     * @return mixed
     */
    public function getCalls()
    {
        return $this->data['calls'];
    }

    /**
     * Method calculates API calls execution time
     *
     * @return number
     */
    public function getTime()
    {
        $time = 0;
        foreach ($this->data['calls'] as $call) {
            $time += $call['time'];
        }

        return $time;
    }

    /**
     * Returns the name of the collector.
     *
     * @return string The collector name
     */
    public function getName()
    {
        return 'curl.request_collector';
    }
}