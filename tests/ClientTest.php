<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\HttpClient;
use Muumuu\Client\Response;

class ClientTest extends TestCase
{
    public function tearDown()
    {
        Client::configure([
            'endpoint' => '',
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

    public function testAuthenticate()
    {
        $expectedToken = 'jwt.token';

        $client = new Client();

        $responseMock = $this->createMock(Response::class);
        $responseMock->method('statusCode')->willReturn(201);
        $responseMock->method('body')->willReturn(['jwt' => $expectedToken]);

        $client->setMock($this->createMockHttpClient('post', '/authentication', $responseMock));
        $client->authenticate('id', 'password');
        $this->assertEquals($expectedToken, $client->getToken());
    }

    public function testGetDomainMaster()
    {
        $client = new Client();
        $client->setMock($this->createMockHttpClient('get', '/domain_master'));
        $client->getDomainMaster();
    }

    public function testGetCarts()
    {
        $client = new Client();
        $client->setMock($this->createMockHttpClient('get', '/carts'));
        $client->getCarts();
    }

    public function testCalcurate()
    {
        $client = new Client();
        $client->setMock($this->createMockHttpClient('post', '/calculate'));
        $client->calculate([
            'cart_domains' => [
                [
                    'sld'           => 'muumuu-domain-test',
                    'tld'           => 'com',
                    'contract_term' => 1
                ]
            ]
        ]);
    }

    private function createMockHttpClient($method, $path, $res = null)
    {
        $mock = $this->getMockBuilder(HttpClient::class)
                     ->disableOriginalConstructor()
                     ->setMethods([$method])
                     ->getMock();
        $mock->expects($this->once())
             ->method($method)
             ->with($this->equalTo($path))
             ->willReturn($res);
        return $mock;
    }
}
