<?php
/**
 * TestHelpers
 *
 * Created 5/25/17 12:12 PM
 * Test helper functions
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier
 */

namespace Pbc\Bandolier;

use Faker\Factory as f;
use Mockery as m;

class HelpersTest extends \PHPUnit_Framework_TestCase
{

    /** @var  f */
    protected static $faker;

    protected function setUp()
    {
        parent::setUp();
        self::$faker = f::create();
    }

    protected function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * Test that if the environment variable is not found then return a default
     */
    public function testGettingDefaultValue()
    {
        $var = strtoupper(implode('_', self::$faker->words()));
        $default = self::$faker->sentence;
        $this->assertSame($default, env($var, $default));
    }

    /**
     * Test getting a value from env()
     */
    public function testGetAPlainValueFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = self::$faker->sentence;
        putenv($var.'='. $value);

        $this->assertSame($value, env($var));
    }
    /**
     * Test getting a true value from env()
     */
    public function testGetATrueValueFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = 'true';
        putenv($var.'='. $value);

        $this->assertTrue(env($var));
    }

    /**
     * Test getting a true value from env() when the value is surrounded by quotes
     */
    public function testGetATrueValueWithQuotesFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = '"true"';
        putenv($var.'='. $value);

        $this->assertTrue(env($var));
    }

    /**
     * Test getting a true value from env() is surrounded by parentheses
     */
    public function testGetATrueValueWithParenthesesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $value = '(true)';
        putenv($var.'='. $value);

        $this->assertTrue(env($var));
    }

    /**
     * Test getting a false value from env()
     */
    public function testGetAFalseValueFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = 'false';
        putenv($var.'='. $value);

        $this->assertFalse(env($var));
    }

    /**
     * Test getting a false value from env() when the value is surrounded by quotes
     */
    public function testGetAFalseValueWithQuotesFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = '"false"';
        putenv($var.'='. $value);

        $this->assertFalse(env($var));
    }

    /**
     * Test getting a false value from env() is surrounded by parentheses
     */
    public function testGetAFalseValueWithParenthesesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $value = '(false)';
        putenv($var.'='. $value);

        $this->assertFalse(env($var));
    }

    /**
     * Test getting a empty value from env()
     */
    public function testGetAEmptyValueFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = 'empty';
        putenv($var.'='. $value);

        $this->assertEmpty(env($var));
    }

    /**
     * Test getting a empty value from env() when the value is surrounded by quotes
     */
    public function testGetAEmptyValueWithQuotesFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = '"empty"';
        putenv($var.'='. $value);

        $this->assertEmpty(env($var));
    }

    /**
     * Test getting a empty value from env() is surrounded by parentheses
     */
    public function testGetAEmptyValueWithParenthesesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $value = '(empty)';
        putenv($var.'='. $value);

        $this->assertEmpty(env($var));
    }
    /**
     * Test getting a null value from env()
     */
    public function testGetANullValueFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = 'null';
        putenv($var.'='. $value);

        $this->assertNull(env($var));
    }

    /**
     * Test getting a null value from env() when the value is surrounded by quotes
     */
    public function testGetANullValueWithQuotesFromEnv()
    {
        $var = strtoupper(self::$faker->word());
        $value = '"null"';
        putenv($var.'='. $value);

        $this->assertNull(env($var));
    }

    /**
     * Test getting a null value from env() is surrounded by parentheses
     */
    public function testGetANullValueWithParenthesesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $value = '(null)';
        putenv($var.'='. $value);

        $this->assertEmpty(env($var));
    }

    /**
     * Test getting a null value from env() is surrounded by parentheses
     */
    public function testGetAValueWithQuotesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $realVal = self::$faker->sentence;
        $value = '"'. $realVal .'"';
        putenv($var.'='. $value);

        $this->assertSame($realVal, env($var));
    }
}
