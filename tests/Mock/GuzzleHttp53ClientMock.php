<?php
/**
 * GuzzleHttpClientMock
 *
 * Fake version of the GuzzleHttp\Client class
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 */

class GuzzleHttp53ClientMock
{
    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function createRequest($request = "GET", $path = "", $params = "")
    {
        return $this;
    }

    public function send($request)
    {
        return $this;
    }

    public function getBody()
    {
        return  "Foo Bar Baz";
    }

    public function get($path="", $params = "")
    {
        return $this;
    }
}