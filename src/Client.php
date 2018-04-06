<?php
namespace Muumuu;

use Muumuu\Client\Config;

class Client {
    private $config;

    public function __construct(array $config = []) {
        $this->config = new Config($config);
    }

    public static function configure(array $config)
    {
        Config::set($config);
    }

    public function getConfig()
    {
        return $this->config;
    }
}
