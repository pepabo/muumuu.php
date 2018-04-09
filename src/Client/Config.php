<?php
namespace Muumuu\Client;

class Config
{
    private static $defaultEndpoint = '';
    private static $defaultToken = '';
    private $endpoint;
    private $token;

    public function __construct(array $config)
    {
        $this->endpoint = isset($config['endpoint']) ? $config['endpoint']
                                                     : self::$defaultEndpoint ?: 'https://muumuu-domain.com/api/v1';
        $this->token = isset($config['token']) ? $config['token']
                                               : self::$defaultToken ?: null;
    }

    public static function set(array $config)
    {
        self::$defaultEndpoint = $config['endpoint'];
        if (isset($config['token']) && !is_null($config['token'])) {
            self::$defaultToken = $config['token'];
        }
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function endpoint()
    {
        return $this->endpoint;
    }

    public function token()
    {
        return $this->token;
    }
}
