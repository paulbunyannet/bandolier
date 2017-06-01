<?php

namespace Pbc\Bandolier\Type;

/**
 * UtilityTest
 *
 * Created 5/31/17 4:42 PM
 * Tests for the utility class
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package ${NAMESPACE}
 */

use \Mockery as m;

/**
 * Mocked function_exists
 * @param $function
 * @return mixed
 */
function function_exists($function)
{
    return LookUpHostIpTest::$functions->function_exists($function);
}

/**
 * Mocked dns_get_record
 * @param $function
 * @return mixed
 */
function dns_get_record($hostname)
{
    return LookUpHostIpTest::$functions->dns_get_record($hostname);
}
/**
 * Class UtilityTest
 * @package Pbc\Bandolier\Type
 */
class LookUpHostIpTest extends \PHPUnit_Framework_TestCase
{

    /** @var m::mock $functions*/
    public static $functions;

    /** @var  \Faker\Factory */
    protected static $faker;

    /**
     * Setup test case
     */
    protected function setUp()
    {
        parent::setUp();
        self::$faker = \Faker\Factory::create();
        self::$functions = m::mock();
    }

    /**
     * tear down test case
     */
    protected function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * Test getting an ip from a domain name
     */
    public function testLookUpHostIpReturnsAnIpAddress()
    {
        $address = "paulbunyan.net";
        self::$functions->shouldReceive('function_exists')->once()->andReturn(true);
        self::$functions->shouldReceive('dns_get_record')->once()->andReturn([['type' => 'A', 'ip' => '127.0.0.1']]);
        $lookUp = Utility::lookUpHostIp($address);
        $this->assertNotFalse(filter_var($lookUp, FILTER_VALIDATE_IP), "$lookUp is an ip address");
    }

    /**
     * check that a fake domain name will not return an ip
     */
    public function testLookUpHostIpReturnsNullIfNoneFound()
    {
        $address = "paulbunyan.net";
        self::$functions->shouldReceive('function_exists')->once()->andReturn(true);
        self::$functions->shouldReceive('dns_get_record')->once()->andReturn([['type' => 'MX', 'ip' => '127.0.0.1']]);
        $lookUp = Utility::lookUpHostIp($address);
        $this->assertNull($lookUp);

    }
    /**
     * check that a not ip is returned if the dns_get_record does not exist
     */
    public function testLookUpHostIpReturnsNullIfFunctionDoesNotExist()
    {
        $address = "paulbunyan.net";
        self::$functions->shouldReceive('function_exists')->once()->andReturn(false);
        $lookUp = Utility::lookUpHostIp($address);
        $this->assertNull($lookUp);
    }
}