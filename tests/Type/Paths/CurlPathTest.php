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
use Pbc\Bandolier\Type\Paths;
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
     * Test curlPath will return url with web init if SERVER_NAME contains .local with env
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithWebInitIfSERVERNAMEContainsLocalWithEnv()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('getDomainNameWeb')->once()->andReturn('web');
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(true);
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));

    }

    /**
     * Test curlPath will return url with web init if SERVER_NAME contains .local with super globals
     * @test
     * @group CurlPath
     * @covers \Pbc\Bandolier\Type\Paths::checkForEnvironmentFile
     */
    public function testCurlPathWillReturnUrlWithWebInitIfSERVERNAMEContainsLocalWithSuperGlobals()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('getDomainNameWeb')->once()->andReturn('web');
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(true);
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(true);
        $this->assertSame('https://web/some_path', Paths::curlPath('/some_path', $pathsMock));
    }

    /**
     * Test curlPath will return url with normal uri if SERVER_NAME contains .local with super globals but the container env files does not exist
     * @test
     * @group CurlPath
     * @covers \Pbc\Bandolier\Type\Paths::checkForEnvironmentFile
     */
    public function testCurlPathWillReturnUrlWithNormalUriIfSERVERNAMEContainsLocalWithSuperGlobalsButTheContainerEnvFilesDoesNotExist()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(true);
        $pathsMock->shouldReceive('checkForEnvironmentFile')->once()->andReturn(false);
        $this->assertSame('https://'.getenv('SERVER_NAME').'/some_path', Paths::curlPath('/some_path', $pathsMock,'non/existent/container/env/.file'));

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
     * Test curlPath will return url without web init if SERVER_NAME does not contain .local with super globals
     * @test
     * @group CurlPath
     */
    public function testCurlPathWillReturnUrlWithoutWebInitIfSERVERNAMEDoesNotContainLocalWithSuperGlobals()
    {
        putenv("SERVER_NAME=somesite.local");
        putenv('SERVER_PORT=' . 443);
        $pathsMock = m::mock('Paths');
        $pathsMock->shouldReceive('getDomainNameWeb')->once()->andReturn('web');
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(true);
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
        $pathsMock->shouldReceive('getDomainNameWeb')->once()->andReturn('web');
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(true);
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
        $pathsMock->shouldReceive('domainNameIsWeb')->once()->andReturn(false);
        $pathsMock->shouldReceive('domainNameIsLocalHost')->once()->andReturn(false);
        $pathsMock->shouldNotReceive('checkForEnvironmentFile');
        $this->assertSame('https://somesite.com/some_path', Paths::curlPath('/some_path', $pathsMock));
    }
}
