<?php

namespace AppBundle\Manager;


interface DownloadManager
{
    public function schedule($spider, $args);

    public function validateState();

    public function consume();
}