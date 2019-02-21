<?php
namespace Pbc\Bandolier\Validate;
/**
 * EmailTest
 *
 * Created 5/24/17 9:33 AM
 * Tests for email validation
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Validate
 */

use Mockery as m;
use Faker\Factory as Faker;

/**
 * @param $dns
 * @return mixed
 */
function checkdnsrr($dns) {
    return EmailTest::$functions->checkdnsrr($dns);
}

/**
 * Class EmailTest
 * @package Pbc\Bandolier\Validate
 */
class EmailTest extends \PHPUnit_Framework_TestCase
{

    /** @var m $functions*/
    public static $functions;
    /** @var  \Faker\Generator */
    protected static $faker;


    /**
     * Setup the test
     */
    protected function setUp()
    {
        parent::setUp();
        self::$functions = m::mock();
        self::$faker = Faker::create();
    }

    /**
     * Tear down the test
     */
    protected function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * Check that a valid email address will return true
     */
    public function testValidateGoodEmailAddress()
    {
        $email = 'validemail'.time().'@gooddns.net';
        self::$functions->shouldReceive('checkdnsrr')->once()->andReturn(true);
        $this->assertTrue(Email::validate($email));
    }

    /**
     * Check that invalid account name will return false
     */
    public function testInvalidAccountSyntaxWillReturnFalse()
    {
        $email = implode(" ", self::$faker->words()).'@gooddns.net';

        self::$functions->shouldReceive('checkdnsrr')->never();
        $this->assertFalse(Email::validate($email));
    }

    /**
     * Test that setting the Filter to an value returns the same value on get
     */
    public function testSetFilter()
    {
        $validate = new Email();
        $filters = ['foo', 'bar'];
        $validate->setFilters($filters);

        $this->assertSame($filters, $validate->getFilters());
    }

    /**
     * Check that initially the filters param is an array
     */
    public function testFiltersIsAnArray()
    {
        $validate = new Email();
        $this->assertTrue(is_array($validate->getFilters()));
    }

    /**
     * Test to make sure that if the filter field is not an array set will throw and exception
     * @expectedException \TypeError
     */
    public function testExceptionThornIfFiltersIsNotAnArray()
    {
        $validate = new Email();
        $filters = 'bar';
        $validate->setFilters($filters);
    }

}
