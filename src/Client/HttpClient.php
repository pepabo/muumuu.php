<?php
namespace Muumuu\Client;

use Muumuu\Client\Config;
use Muumuu\Client\Response;

class HttpClient
{
    private $config;
    private $httpClient;
    private $token = null;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function get($path = '', $params = [])
    {
        $response = $this->request('GET', $path, $params);
        return new Response($response);
    }

    public function post($path = '', $params = [])
    {
        $response = $this->request('POST', $path, $params);
        return new Response($response);
    }

    private function request($method, $path, $params)
    {
        $options = [
            'http_errors' => false,
            'headers' => [
                'Content-Type: ' => 'application/json'
            ],
            'json' => $params
        ];

        if (!is_null($this->getToken())) {
            $options['headers']['Authorization'] = 'Bearer ' . $this->getToken();
        }

        return $this->httpClient()->request($method, $this->config->endpoint().$path, $options);
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    private function httpClient()
    {
        return $this->httpClient ?: $this->httpClient = new \GuzzleHttp\Client();
    }

    public function setHttpClient($client)
    {
        $this->httpClient = $client;
    }
}
