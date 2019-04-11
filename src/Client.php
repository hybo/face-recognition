<?php

namespace FaceRecognition;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class Client implements FactoryInterface
{
    protected $config;

    protected $request;

    protected $initialDrivers = [
        'baidu' => 'BaiduBCE',
        'face++' => 'FPP',
        'tencent-youtu' => 'TencentYoutu',
    ];

    protected $drivers = [];

    public function __construct(array $config, Request $request = null)
    {
        $this->config = new Config($config);

        if ($request) {
            $this->setRequest($request);
        }
    }

    public function config(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    public function driver($driver)
    {
        if (!isset($this->drivers[$driver])) {
            $this->drivers[$driver] = $this->createDriver($driver);
        }

        return $this->drivers[$driver];
    }

    protected function createDriver($driver)
    {
        if (isset($this->initialDrivers[$driver])) {
            $provider = $this->initialDrivers[$driver];
            $adapter = __NAMESPACE__ . '\\Adapters\\' . $provider . 'Adapter';
            $provider = __NAMESPACE__ . '\\Providers\\' . $provider . 'Provider';

            return $this->buildAdapter($adapter, $this->buildProvider($provider, $this->config->get($driver)));
        }

        throw new InvalidArgumentException("Driver [{$driver}] not supported.");
    }

    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }

    public function getRequest()
    {
        return $this->request ?: $this->createDefaultRequest();
    }

    protected function createDefaultRequest()
    {
        $request = Request::createFromGlobals();
        $session = new Session();

        $request->setSession($session);

        return $request;
    }

    public function getDrivers()
    {
        return $this->drivers;
    }

    private function buildProvider($provider, $config)
    {
        return new $provider($this->getRequest(), $config);
    }

    private function buildAdapter($adapter, $provider)
    {
        return new $adapter($provider);
    }
}