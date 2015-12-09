<?php

namespace CurlBundle\Collector;

interface CollectorInterface
{
    function collect();

    function retrieve();
}