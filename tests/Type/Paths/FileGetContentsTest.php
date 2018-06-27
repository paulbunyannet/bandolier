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

use Mockery as m;
use Pbc\Bandolier\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

class FileGetContentsTest extends BandolierTestCase
{

    /**
     * Setup the test
     */
    public function setUp()
    {
        parent::setUp();

    }

    /**
     * Tear down the test
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
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
