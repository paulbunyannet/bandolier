<?php
namespace Pbc\Bandolier\Type;
/**
 * GetKeyTest
 *
 * Created 7/14/17 6:46 PM
 * Testing the getKey method on the Arrays type
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Arrays
 * @subpackage Subpackage
 */


use Pbc\Bandolier\BandolierTestCase;

class GetKeyTest extends BandolierTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test getting a key by string value that is in the array
     *
     * @test
     * @group GetKey
     */
    public function testGettingAKeyByStringValueThatIsInTheArray()
    {
        $value = implode('-', self::$faker->words(4));
        $key = implode('-', self::$faker->words(2));
        $data = [$key => $value];
        $this->assertSame($key, Arrays::getKey($data, $value));
    }

    /**
     * Test getting a key from an array with value of an array
     * @test
     * @group GetKey
     */
    public function testGettingAKeyFromAnArrayWithValueOfAnArray()
    {
      $value = [self::$faker->word, self::$faker->word, self::$faker->word];
      $key = implode('-', self::$faker->words(2));
      $data = [$key => $value];
      $this->assertSame($key, Arrays::getKey($data, $value));
    }

    /**
     * Test getting a key from an array will return null if a different type was submitted
     * @tests
     * @group GetKey
     */
     public function testGettingAKeyFromAnArrayWillReturnNullIfADifferentTypeWasSubmitted()
     {
       $value = "1";
       $key = "key";
       $data = [$key => $value];
       $this->assertNull(Arrays::getKey($data, intval($value)));
       $this->assertNull(Arrays::getKey($data, (array)$value));
     }

    /**
     * Test getting a key from an array with value that is not in array will return null
     * @test
     * @group GetKey
     */
    public function testGettingAKeyFromAnArrayWithValueThatIsNotInArrayWillReturnNull()
    {
      $value = implode('-', self::$faker->words(4));
      $key = implode('-', self::$faker->words(2));
      $data = [$key => $value];

      $this->assertNull(Arrays::getKey($data, $value . 'nope'));
    }


    /**
     * Test getting a key from an array with value of an array that is not the same will return null
     * @test
     * @group GetKey
     */
    public function testGettingAKeyFromAnArrayWithValueOfAnArrayThatIsNotTheSameWillReturnNull()
    {
      $value = [self::$faker->word, self::$faker->word, self::$faker->word];
      $key = implode('-', self::$faker->words(2));
      $data = [$key => $value];
      $this->assertNull(Arrays::getKey($data, array_merge($value, ['foo'])));
    }


    /**
     * Test getting a key from an array that is not the same type will return null
     * @test
     * @group GetKey
     */
    public function testGettingAKeyFromAnArrayThatIsNotTheSameTypeWillReturnNull()
    {
      $value = [self::$faker->word, self::$faker->word, self::$faker->word];
      $key = implode('-', self::$faker->words(2));
      $data = [$key => $value];
      $this->assertNull(Arrays::getKey($data, (object)$value));
    }


    /**
     * Test getting a key from an array that does not exist will return a default value
     * @test
     * @group GetKey
     */
    public function testGettingAKeyFromAnArrayThatDoesNotExistWillReturnADefaultValue()
    {
      $data = ['key' => 'value'];
      $this->assertSame(Arrays::getKey($data, 'unknown', 'default'), 'default');
    }
}
