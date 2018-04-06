<?php
namespace Muumuu\Client;

class Config
{
    private static $defaultEndpoint = null;
    private $endpoint;

    public function __construct(array $config)
    {
        $this->endpoint = isset($config['endpoint']) ? $config['endpoint']
                                                     : self::$defaultEndpoint ?: 'https://muumuu-domain.com/api/v1';
    }

    public static function set(array $config)
    {
        self::$defaultEndpoint = $config['endpoint'];
    }

    public function endpoint()
    {
        return $this->endpoint;
    }
}
