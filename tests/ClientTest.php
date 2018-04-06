<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\HttpClient;

class ClientTest extends TestCase
{
    public function tearDown()
    {
        Client::configure([
            'endpoint' => null,
        ]);
    }

    public function testConfigure()
    {
        Client::configure([
            'endpoint' => 'https://test.muumuu-domain.com/api/v1',
        ]);

        $client = new Client();
        $this->assertEquals('https://test.muumuu-domain.com/api/v1', $client->getConfig()->endpoint());
    }

    public function testGetDomainMaster()
    {
        $mock = $this->createMock(HttpClient::class);
        $mock->expects($this->once())
             ->method('get')
             ->with($this->equalTo('/domain_master'));

        $client = new Client();
        $client->setMock($mock);
        $client->getDomainMaster();
    }
}
