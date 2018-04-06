<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\HttpClient;

class ClientTest extends TestCase
{
    public function tearDown()
    {
        Client::configure([
            'endpoint' => '',
            'token' => '',
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
        $client = new Client();
        $client->setMock($this->createMockHttpClient('/domain_master'));
        $client->getDomainMaster();
    }

    public function testGetCarts()
    {
        $client = new Client();
        $client->setMock($this->createMockHttpClient('/carts'));
        $client->getCarts();
    }

    private function createMockHttpClient($path)
    {
        $mock = $this->createMock(HttpClient::class);
        $mock->expects($this->once())
             ->method('get')
             ->with($this->equalTo($path));
        return $mock;
    }
}
