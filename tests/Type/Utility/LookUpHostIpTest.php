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


/**
 * Class UtilityTest
 * @package Pbc\Bandolier\Type
 */
class LookUpHostIpTest extends \PHPUnit_Framework_TestCase
{

    /** @var  \Faker\Factory */
    protected static $faker;

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        self::$faker = \Faker\Factory::create();
    }

    /**
     *
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test getting an ip from a domain name
     */
    public function testLookUpHostIpReturnsAnIpAddress()
    {
        $address = "paulbunyan.net";
        $lookUp = Utility::lookUpHostIp($address);
        $this->assertNotFalse(filter_var($lookUp, FILTER_VALIDATE_IP), "$lookUp is an ip address");
    }

    /**
     * check that a fake domain name will not return an ip
     */
    public function testLookUpHostIpReturnsNullIfNoneFound()
    {
        $address = self::$faker->sha256.".com";
        $lookUp = Utility::lookUpHostIp($address);
        $this->assertNull($lookUp);

    }
}
