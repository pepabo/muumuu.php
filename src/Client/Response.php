<?php
namespace Muumuu\Client;

class Response
{
    private $response;

    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->response = $response;
    }

    public function statusCode()
    {
        return $this->response->getStatusCode();
    }

    public function body()
    {
        return json_decode($this->response->getBody(), true); // array
    }
}
