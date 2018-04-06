<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\Config;
use Muumuu\Client\HttpClient;

class HttpClientTest extends TestCase
{
    public function testGet()
    {
        $path = '/hello';

        $mock = $this->createMock(\GuzzleHttp\Client::class);
        $mock->expects($this->once())
             ->method('request')
             ->with(
                 $this->equalTo('GET'),
                 $this->equalTo("https://muumuu-domain.com/api/v1{$path}")
             )
             ->will($this->returnValue($this->createMockResponse()));

        $client = new HttpClient(new Config([]));
        $client->setMock($mock);

        $response = $client->get($path);
        $this->assertEquals(200, $response->statusCode());
        $this->assertEquals(['muumuu' => 'domain'], $response->body());
    }

    private function createMockResponse() {
        return new \GuzzleHttp\Psr7\Response(
            200,                    // statusCode
            [],                     // header
            '{"muumuu": "domain"}'  // body
        );
    }
}
