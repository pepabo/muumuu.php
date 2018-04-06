<?php
namespace Muumuu\Client;

use Muumuu\Client\Config;
use Muumuu\Client\Response;

class HttpClient
{
    private $config;
    private $httpClient;

    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function get($path = '') {
        $response = $this->httpClient()->request('GET', $this->config->endpoint().$path);
        return new Response($response);
    }

    private function httpClient() {
        return $this->httpClient ?: $this->httpClient = new \GuzzleHttp\Client();
    }

    public function setMock($mock) {
        $this->httpClient = $mock;
    }
}
