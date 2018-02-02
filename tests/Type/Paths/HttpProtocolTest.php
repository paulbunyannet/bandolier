<?php
/**
 * HttpProtocolTest
 *
 * Created 6/28/17 10:26 AM
 * Tests for the HttpProtocol class.
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Paths
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;

class HttpProtocolTest extends BandolierTestCase
{

    /**
     * test httpProtocol returns http if HTTPS is empty
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfHttpsIsEmptyByEnv()
    {
        putenv('HTTPS=');
        putenv('SERVER_PORT=' . 900);
        //var_dump($_SERVER['SERVER_PORT']);
        $this->assertSame('http', Paths::httpProtocol());
    }
    /**
     * test httpProtocol returns http if HTTPS is empty
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfHttpsIsEmptyBySuperGlobal()
    {
        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 900);
        $this->assertSame('http', Paths::httpProtocol());
    }
    /**
     * test httpProtocol returns http if HTTPS is off
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfHttpsIsOffByEnv()
    {
        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 80);
        $this->assertSame('http', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns http if HTTPS is off
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfHttpsIsOffBySuperGlobal()
    {
        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 900);
        $this->assertSame('http', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns http if SERVER_PORT is not set to 443
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfServerPortIsNotFourFourThreeByEnv()
    {
        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 80);
        $this->assertSame('http', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns http if SERVER_PORT is not set to 443
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpIfServerPortIsNotFourFourThreeBySuperGlobal()
    {
        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 900);
        $this->assertSame('http', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns https if HTTPS is set to other than off
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpsIfHTTPSIsSetToOtherThanOffWithEnv()
    {

        putenv('HTTPS=on');
        putenv('SERVER_PORT=' . 80);
        $this->assertSame('https', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns https if HTTPS is set to other than off
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpsIfHTTPSIsSetToOtherThanOffWithSuperGlobal()
    {

        putenv('HTTPS=on');
        putenv('SERVER_PORT=' . 900);
        $this->assertSame('https', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns https if SERVER_PORT is set to 443
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpsIfServerPortIsSetToFourFourThreeWithEnv()
    {

        putenv('HTTPS='.null);
        putenv('SERVER_PORT=' . 443);
        $this->assertSame('https', Paths::httpProtocol());
    }

    /**
     * test httpProtocol returns https if SERVER_PORT is set to 443
     * @test
     * @group HttpProtocol
     */
    public function testHttpProtocolReturnsHttpsIfServerPortIsSetToFourFourThreeWithSuperGlobal()
    {

        putenv('HTTPS=off');
        putenv('SERVER_PORT=' . 443);
        $this->assertSame('https', Paths::httpProtocol());
    }
}
