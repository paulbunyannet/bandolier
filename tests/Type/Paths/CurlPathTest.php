<?php
/**
 * CurlPathTest
 *
 * Created 6/28/17 10:26 AM
 * Tests for the curlPath method on Paths.
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Paths
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

use Mockery as m;
use Pbc\Bandolier\BandolierTestCase;

class CurlPathTest extends BandolierTestCase
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
     * Test curlPath will return url with web init if SERVER_NAME containes .local with env
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithWebInitIfSERVERNAMEContainesLocalWithEnv()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));

    }

    /**
     * Test curlPath will return url with web init if SERVER_NAME containes .local with super globals
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithWebInitIfSERVERNAMEContainesLocalWithSuperGlobals()
    {
        putenv("SERVER_NAME");
        putenv('SERVER_PORT');
        $_SERVER['SERVER_NAME'] = 'somesite.local';
        $_SERVER['SERVER_PORT'] = 443;
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));

    }


    /**
     * Test curlPath will return url without web init if SERVER_NAME does not contain .local with env
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithoutWebInitIfSERVERNAMEDoesNotContainLocalWithEnv()
    {
        putenv("SERVER_NAME=somesite.com");
        putenv('SERVER_PORT=' . 443);
        $this->assertSame('https://somesite.com/some_path', Paths::curlPath('/some_path'));

    }

    /**
     * Test curlPath will retrn url without web init if SERVER_NAME does not contain .local with super globals
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillRetrnUrlWithoutWebInitIfSERVERNAMEDoesNotContainLocalWithSuperGlobals()
    {
        putenv("SERVER_NAME");
        putenv('SERVER_PORT');
        $_SERVER['SERVER_NAME'] = 'somesite.local';
        $_SERVER['SERVER_PORT'] = 443;
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));

    }

    /**
     * Test curlPath will return url with web init if /.dockerenv file exists
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithWebInitIfSERVERNAMEDoesNotContainLocalWithEnv()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));
    }


    /**
     * Test curlPath will return url with regular server name if not .local
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithRegularServerNameIfNotLocal()
    {
        putenv("SERVER_NAME=somesite.com");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldNotReceive('checkForEnvironmentFile');
        $this->assertSame('https://somesite.com/some_path', Paths::curlPath('/some_path', $pathsMock));
    }


}
