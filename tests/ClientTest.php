<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testConfigure()
    {
        Client::configure([
            'endpoint' => 'https://test.muumuu-domain.com/api/v1',
        ]);

        $client = new Client();
        $this->assertEquals('https://test.muumuu-domain.com/api/v1', $client->getConfig()->endpoint());
    }
}
