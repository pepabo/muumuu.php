<?php
namespace Muumuu;

use Muumuu\Client\Config;
use Muumuu\Client\HttpClient;

class Client {
    private $config;
    private $httpClient;

    public function __construct(array $config = []) {
        $this->config = new Config($config);
        $this->httpClient = new HttpClient($this->config);
    }

    public static function configure(array $config)
    {
        Config::set($config);
    }

    public function getDomainMaster()
    {
        return $this->httpClient->get('/domain_master');
    }

    public function getCarts()
    {
        return $this->httpClient->get('/carts');
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setMock($mock) {
        $this->httpClient = $mock;
    }
}
