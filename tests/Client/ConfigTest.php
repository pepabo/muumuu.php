<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\Config;

class ConfigTest extends TestCase
{
    public function tearDown()
    {
        Config::set([
            'endpoint' => '',
            'token' => '',
        ]);
    }

    public function testDefault()
    {
        $config = new Config([]);
        $this->assertEquals('https://muumuu-domain.com/api/v1', $config->endpoint());
        $this->assertEquals(null, $config->token());
    }

    public function testSet()
    {
        Config::set([
            'endpoint' => 'https://test.muumuu-domain.com/api/v1',
            'token' => 'bearer-token-xxx'
        ]);
        $config = new Config([]);
        $this->assertEquals('https://test.muumuu-domain.com/api/v1', $config->endpoint());
        $this->assertEquals('bearer-token-xxx', $config->token());
    }
}
