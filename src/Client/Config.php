<?php
namespace Muumuu\Client;

class Config
{
    private static $defaultEndpoint = 'https://muumuu-domain.com/api/v1';
    private $endpoint;

    public function __construct(array $config)
    {
        $this->endpoint = isset($config['endpoint']) ?: self::$defaultEndpoint;
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
