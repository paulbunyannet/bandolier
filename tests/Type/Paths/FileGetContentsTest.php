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

namespace Tests\Type\Paths;

use Pbc\Bandolier\Exception\Type\Paths\FileGetContentsException;
use Tests\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;
use Tests\Mock\GuzzleHttp53ClientMock;
use Tests\Mock\GuzzleHttpClientMock;

class FileGetContentsTest extends BandolierTestCase
{

    /**
     * @test
     * @group FileGetContent
     */
    public function testFileGetContentsWillThrowExceptionIfClientIncorrect()
    {
        $this->expectException(FileGetContentsException::class);
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
            "client" => new GuzzleHttpClientMock($clientParams),
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
            "client" => new GuzzleHttp53ClientMock($clientParams),
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
            "client" => "Tests\\Mock\\GuzzleHttpClientMock",
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);

        $this->assertSame($body, $getBody);
    }

    /**
     * Test that FileGetContents throws an exception if the client isn't an instance of \GuzzleHttp\Client
     * @test
     * @group FileGetContents
     */
    public function testThatFileGetContentsThrowsAnExceptionIfTheClientIsnTAnInstanceOfGuzzleHttpClient()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The client must be an instance of \GuzzleHttp\Client');
        $body = "Foo Bar Baz";
        $request = "GET";
        $clientParams = ["foo" => "bar"];

        Paths::fileGetContents([
            "toPath" => "http://foobar.com/bla",
            "client" => new \stdClass(),
            "clientParams" => $clientParams,
            "request" => $request,
            "requestParams" => []
        ]);
    }
}
