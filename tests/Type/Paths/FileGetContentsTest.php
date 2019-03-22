<?php
/**
 * FileGetContentsTest
 *
 * Tests for the Paths::fileGetContents() method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Paths
 * @subpackage Subpackage
 */

namespace Type\Paths;

use Pbc\Bandolier\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

class FileGetContentsTest extends BandolierTestCase
{

    /**
     * @test
     * @group FileGetContent
     * @expectedException \Pbc\Bandolier\Exception\Type\Paths\FileGetContentsException
     */
    public function testFileGetContentsWillThrowExceptionIfClientIncorrect()
    {
        $body = "Foo Bar Baz";
        $request = "GET";
        $clientParams = ["foo" => "bar"];

        $getBody = Paths::fileGetContents([
            "toPath" => "http://foobar.com/bla",
            "client" => new \stdClass(),
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);
    }

    /**
     * Test that FileGetContents can do a request and return the page content when client is a class
     * @test
     * @group FileGetContents
     */
    public function testThatFileGetContentsCanDoARequestAndReturnThePageContentWhenClientIsAClass()
    {
        $body = "Foo Bar Baz";
        $request = "GET";
        $clientParams = ["foo" => "bar"];

        $getBody = Paths::fileGetContents([
            "toPath" => "http://foobar.com/bla",
            "client" => new \GuzzleHttpClientMock($clientParams),
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);

        $this->assertSame($body, $getBody);
    }

    /**
     * Test that FileGetContents can do a request and return the page content when client is a class
     * using GuzzleHttp 5.3 style
     * @test
     * @group FileGetContents
     */
    public function testThatFileGetContentsCanDoARequestAndReturnThePageContentWhenClientIsAClassWithGuzzleHttp53()
    {
        $body = "Foo Bar Baz";
        $request = "GET";
        $clientParams = ["foo" => "bar"];

        $getBody = Paths::fileGetContents([
            "toPath" => "http://foobar.com/bla",
            "client" => new \GuzzleHttp53ClientMock($clientParams),
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);

        $this->assertSame($body, $getBody);
    }
    /**
     * Test that FileGetContents can do a request and return the page content when client is a string
     * @test
     * @group FileGetContents
     */
    public function testThatFileGetContentsCanDoARequestAndReturnThePageContentWhenClientIsAString()
    {
        $body = "Foo Bar Baz";
        $request = "GET";
        $clientParams = ["foo" => "bar"];

        $getBody = Paths::fileGetContents([
            "toPath" => "http://foobar.com/bla",
            "client" => "\\GuzzleHttpClientMock",
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);

        $this->assertSame($body, $getBody);
    }
}
