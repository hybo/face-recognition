<?php

namespace FaceRecognition\Providers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Cache\Simple\FilesystemCache;

abstract class AbstractProvider
{
    protected $request;

    protected $config;

    protected $options = [];

    public function __construct(Request $request, $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getHttpClient()
    {
        return new Client();
    }

    protected function cache()
    {
        return new FilesystemCache();
    }
}