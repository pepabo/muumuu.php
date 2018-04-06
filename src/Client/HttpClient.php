<?php
namespace Muumuu\Client;

use Muumuu\Client\Config;
use Muumuu\Client\Response;

class HttpClient
{
    private $config;
    private $httpClient;

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
            'json' => $params
        ];

        if (!empty($this->config->token())) {
            $options = array_merge($options, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->config->token()
                ]
            ]);
        }

        return $this->httpClient()->request($method, $this->config->endpoint().$path, $options);
    }

    private function httpClient()
    {
        return $this->httpClient ?: $this->httpClient = new \GuzzleHttp\Client();
    }

    public function setMock($mock)
    {
        $this->httpClient = $mock;
    }
}
