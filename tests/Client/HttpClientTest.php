<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\Config;
use Muumuu\Client\HttpClient;

class HttpClientTest extends TestCase
{
    public function tearDown()
    {
        Config::set([
            'endpoint' => '',
        ]);
    }

    public function testWithToken()
    {
        $path = '/hello';

        $client = new HttpClient(new Config([]));
        $client->setToken('bearer-token-xxx');
        $client->setMock($this->createMockClient('GET', $path, [], ['Authorization' => 'Bearer bearer-token-xxx']));

        $response = $client->get($path);
    }

    public function testGet()
    {
        $path = '/hello';

        $client = new HttpClient(new Config([]));
        $client->setMock($this->createMockClient('GET', $path));

        $response = $client->get($path);
        $this->assertEquals(200, $response->statusCode());
        $this->assertEquals(['muumuu' => 'domain'], $response->body());
    }

    public function testPost()
    {
        $path = '/hello';

        $client = new HttpClient(new Config([]));
        $client->setMock($this->createMockClient('POST', $path));

        $response = $client->post($path);
        $this->assertEquals(200, $response->statusCode());
        $this->assertEquals(['muumuu' => 'domain'], $response->body());
    }

    private function createMockClient($method, $path, array $params = [], array $headers = [])
    {
        $options = [
            'http_errors' => false,
            'headers' => [
                'Content-Type: ' => 'application/json'
            ],
            'json' => $params
        ];
        if ($headers) {
            $options['headers'] = array_merge($options['headers'], $headers);
        }

        $mock = $this->createMock(\GuzzleHttp\Client::class);
        $mock->expects($this->once())
             ->method('request')
             ->with(
                 $this->equalTo($method),
                 $this->equalTo("https://muumuu-domain.com/api/v1{$path}"),
                 $this->equalTo($options)
             )
             ->will($this->returnValue($this->createMockResponse()));

        return $mock;
    }

    private function createMockResponse()
    {
        return new \GuzzleHttp\Psr7\Response(
            200,                    // statusCode
            [],                     // header
            '{"muumuu": "domain"}'  // body
        );
    }
}
