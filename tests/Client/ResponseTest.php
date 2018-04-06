<?php
namespace Muumuu;

use PHPUnit\Framework\TestCase;
use Muumuu\Client\Response;

class ResponseTest extends TestCase
{
    public function testStatusCode()
    {
        $response = new Response($this->createMockResponse());
        $this->assertEquals(200, $response->statusCode());
    }

    public function testBody()
    {
        $response = new Response($this->createMockResponse());
        $this->assertEquals(["muumuu" => "domain"], $response->body());
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
