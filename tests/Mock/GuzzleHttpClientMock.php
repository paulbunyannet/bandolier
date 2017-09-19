<?php
/**
 * GuzzleHttpClientMock
 *
 * Fake version of the GuzzleHttp\Client class
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 */

class GuzzleHttpClientMock
{
    protected $config = [];

    public function __construct(array $config = [])
    {
        $this->config = $config;
        return $this;
    }

    public function request($request = "GET", $path = "", $params = "")
    {
        return $this;
    }

    public function getBody()
    {
        return $this;
    }

    public function getContents()
    {
        return  "Foo Bar Baz";
    }

    public function get($path="", $params = "")
    {
        return $this;
    }
}