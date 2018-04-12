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

    /**
     * authenticate
     *
     * @param string $id        muumuu-domain user id (muumuu-id)
     * @param string $password  muumuu-domain user password
     * @return boolean
     */
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

    /**
     * create WordPress
     * (required authentication)
     *
     * @param array $params
     *   domain_name    : domain name
     *   sub_domain     : sub domain
     *   username       : username for WordPress administrator
     *   password       : password for WordPress administrator
     *   payment_method : payment method (require registered in muumuu-domain)
     *     - 'creditcard'  : creditcard
     *     - 'osaipo'      : osaipo(https://osaipo.jp/)
     * @return Muumuu\Client\Response
     */
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
