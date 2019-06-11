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
     * @test testGettingDefaultValue
     * @group env
     */
    public function testGettingDefaultValue()
    {
        $var = strtoupper(implode('_', self::$faker->words()));
        $default = self::$faker->sentence;
        $this->assertSame($default, env($var, $default));
    }

    /**
     * Test getting a value from env()
     * @test testGetAPlainValueFromEnv
     * @group env
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
     * @test testGetATrueValueFromEnv
     * @group env
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
     * @test testGetATrueValueWithQuotesFromEnv
     * @group env
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
     * @test testGetATrueValueWithParenthesesFromEnc
     * @group env
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
     * @test testGetAFalseValueFromEnv
     * @group env
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
     * @test testGetAFalseValueWithQuotesFromEnv
     * @group env
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
     * @test testGetAFalseValueWithParenthesesFromEnc
     * @group env
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
     * @test testGetAEmptyValueFromEnv
     * @group env
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
     * @test testGetAEmptyValueWithQuotesFromEnv
     * @group env
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
     * @test testGetAEmptyValueWithParenthesesFromEnc
     * @group env
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
     * @test testGetANullValueFromEnv
     * @group env
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
     * @test testGetANullValueWithQuotesFromEnv
     * @group env
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
     * @test testGetANullValueWithParenthesesFromEnc
     * @group env
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
     * @test testGetAValueWithQuotesFromEnc
     * @group env
     */
    public function testGetAValueWithQuotesFromEnc()
    {
        $var = strtoupper(self::$faker->word());
        $realVal = self::$faker->sentence;
        $value = '"'. $realVal .'"';
        putenv($var.'='. $value);

        $this->assertSame($realVal, env($var));
    }

    /**
     * @test testGetAttributeCanFindKeyInArray
     * @group GetAttribute
     */
    public function testGetAttributeCanFindKeyInArray()
    {
        $value = 'foo';
        $key = 'bar';
        $data = [$key => $value];
        $this->assertSame($value, getAttribute($data, $key));
    }

    /**
     * @test testAttributeWillReturnNullIfNoDefaultIsSetAndTheKeyIsNotFoundInArray
     * @group GetAttribute
     */
    public function testGetAttributeWillReturnNullIfNoDefaultIsSetAndTheKeyIsNotFoundInArray()
    {
        $value = 'foo';
        $key = 'bar';
        $data = [$key => $value];
        $this->assertNull(getAttribute($data, 'bazz'));
    }

    /**
     * @test testGetAttributeWillReturnDefaultIfKeyIsNotFound
     * @group GetAttribute
     */
    public function testGetAttributeWillReturnDefaultIfKeyIsNotFound()
    {
        $value = 'foo';
        $key = 'bar';
        $default = 'bin';
        $data = [$key => $value];
        $this->assertSame($default, getAttribute($data, 'bazz', $default));
    }
    /**
     * @test testGetAttributeWillReturnDefaultIfKeyIsNotSet
     * @group getAttribute
     */
    public function testGetAttributeWillReturnDefaultIfKeyIsNotSet()
    {
        $value = 'foo';
        $key = 'bar';
        $default = 'bin';
        $data = [$key => $value];
        $this->assertSame($default, getAttribute($data, null, $default));
    }

    /**
     * @test
     */
    public function testThatStudlyCaseReturnsStudlyString()
    {
        $this->assertEquals('BandolierPHPToolbox', studlyCase('bandolier_p_h_p_toolbox'));
        $this->assertEquals('BandolierPhpToolbox', studlyCase('bandolier_php_toolbox'));
        $this->assertEquals('BandolierPhPToolbox', studlyCase('bandolier-phP-toolbox'));
        $this->assertEquals('BandolierPhpToolbox', studlyCase('bandolier  -_-  php   -_-   toolbox   '));
    }
    /**
     * @test
     */
    public function testThatCamelCaseCaseReturnsCamelCaseString()
    {
        $this->assertEquals('bandolierPHPToolbox', camelCase('bandolier_p_h_p_toolbox'));
        $this->assertEquals('bandolierPhpToolbox', camelCase('bandolier_php_toolbox'));
        $this->assertEquals('bandolierPhPToolbox', camelCase('bandolier-phP-toolbox'));
        $this->assertEquals('bandolierPhpToolbox', camelCase('bandolier  -_-  php   -_-   toolbox   '));
    }

    /**
     * @test
     */
    public function testThatSnakeCaseReturnsSnakeCaseString()
    {
        $this->assertEquals('bandolier_p_h_p_toolbox', snakeCase('BandolierPHPToolbox'));
        $this->assertEquals('bandolier_php_toolbox',   snakeCase('BandolierPhpToolbox'));
        $this->assertEquals('bandolier php toolbox',   snakeCase('BandolierPhpToolbox', ' '));
        $this->assertEquals('bandolier_php_toolbox',   snakeCase('Bandolier Php Toolbox'));
        $this->assertEquals('bandolier_php_toolbox',   snakeCase('Bandolier         Php          Toolbox        '));
        // ensure cache keys don't overlap
        $this->assertEquals('bandolier__php__toolbox', snakeCase('BandolierPhpToolbox', '__'));
        $this->assertEquals('bandolier_php_toolbox_',  snakeCase('BandolierPhpToolbox_', '_'));
        $this->assertEquals('bandolier_php_toolbox',   snakeCase('bandolier php toolbox'));
        $this->assertEquals('bandolier_php_tool_box',  snakeCase('bandolier php ToolBox'));
    }

    /**
     * @test
     */
    public function testThatKebabCaseReturnsKebabString()
    {
        $this->assertEquals('bandolier-p-h-p-toolbox', kebabCase('BandolierPHPToolbox'));
        $this->assertEquals('bandolier-php-toolbox',   kebabCase('BandolierPhpToolbox'));
        $this->assertEquals('bandolier-php-toolbox',   kebabCase('Bandolier Php Toolbox'));
        $this->assertEquals('bandolier-php-toolbox',   kebabCase('Bandolier         Php          Toolbox        '));
        // ensure cache keys don't overlap
        $this->assertEquals('bandolier-php-toolbox', kebabCase('BandolierPhpToolbox'));
        $this->assertEquals('bandolier-php-toolbox_',  kebabCase('BandolierPhpToolbox_'));
        $this->assertEquals('bandolier-php-toolbox',   kebabCase('bandolier php toolbox'));
        $this->assertEquals('bandolier-php-tool-box',  kebabCase('bandolier php ToolBox'));
    }
}
