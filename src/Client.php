<?php
namespace Muumuu;

use Muumuu\Client\Config;
use Muumuu\Client\HttpClient;

class Client
{
    private $config;
    private $httpClient;

    public function __construct(array $config = [])
    {
        $this->config = new Config($config);
        $this->httpClient = new HttpClient($this->config);
    }

    public static function configure(array $config)
    {
        Config::set($config);
    }

    public function authenticate($id, $password)
    {
        $res = $this->httpClient->post('/authentication', [
            'id' => $id,
            'password' => $password
        ]);

        if ($res->statusCode() !== 201) {
            return false;
        }

        $this->setToken($res->body()['jwt']);
        return true;
    }

    public function getDomainMaster()
    {
        return $this->httpClient->get('/domain_master');
    }

    public function getCarts()
    {
        return $this->httpClient->get('/carts');
    }

    public function calculate($params)
    {
        return $this->httpClient->post('/calculate', ['cart' => $params]);
    }

    public function createWordpress(array $params)
    {
        return $this->httpClient->post('/wordpress', ['wordpress' => $params]);
    }

    public function setToken($token)
    {
        $this->httpClient->setToken($token);
    }

    public function getToken()
    {
        return $this->httpClient->getToken();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function setMock($mock)
    {
        $this->httpClient = $mock;
    }
}
