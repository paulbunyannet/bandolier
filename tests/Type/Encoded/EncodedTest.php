<?php
namespace Pbc\Bandolier\Type;
/**
 * EncodedTest
 *
 * Created 10/3/16 3:16 PM
 * Tests for the Encoded class
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

use Pbc\Bandolier\BandolierTestCase;

/**
 * Class EncodedTest
 * @package Pbc\Bandolier\Type
 */
class EncodedTest extends BandolierTestCase
{

    /**
     * @return array
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @return array
     */
    public function teatDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     * @group encoded-isJson
     * @group encoded
     */
    public function a_json_string_will_return_true()
    {
        $this->assertTrue(Encoded::isJson('["1","2","3"]'));
        $this->assertTrue(Encoded::isJson('{"a":"b","c":"d"}'));
    }

    /**
     * @test
     * @group encoded
     * @group encoded-isJson
     */
    public function an_unformatted_json_string_will_return_false()
    {
        $this->assertFalse(Encoded::isJson(time()));
        $this->assertFalse(Encoded::isJson('ABCDE'));
        $this->assertFalse(Encoded::isJson('{12345}'));
        $this->assertFalse(Encoded::isJson('[ABCDE]'));
    }

    /**
     * @test
     * @group encoded
     * @group encoded-isSerialized
     */
    public function a_serialized_string_will_return_true()
    {
        $this->assertTrue(Encoded::isSerialized('a:1:{s:1:"a";s:1:"b";}'));
    }

    /**
     * @test
     * @group encoded
     * @group encoded-isSerialized
     */
    public function an_unformatted_serialized_string_will_return_false()
    {
        $this->assertFalse(Encoded::isSerialized(time()));
        $this->assertFalse(Encoded::isSerialized('ABCDE'));
    }

    /**
     * @test
     * @group encoded
     * @group encoded-getThingThatIsEncoded
     */
    public function a_thing_can_be_found_in_a_json_array()
    {
        $key = 'a';
        $value = 'b';
        $data = '{"'.$key.'":"'.$value.'","c":"d"}';
        $this->assertSame(Encoded::getThingThatIsEncoded($data, $key), $value);
    }

    /**
     * @test
     * @group encoded
     * @group encoded-getThingThatIsEncoded
     */
    public function a_thing_can_be_found_in_a_serialized_array()
    {
        $key = 'a';
        $value = 'b';
        $data = 'a:1:{s:1:"'. $key .'";s:1:"'.$value.'";}';
        $this->assertSame(Encoded::getThingThatIsEncoded($data, $key), $value);
    }
    /**
     * An element can be found in a base64 encoded string
     * @test
     * @group encoded
     * @group encoded-getThingThatIsEncoded
     */
    public function an_element_can_be_found_in_a_base64_encoded_string()
    {
        $key = 'a';
        $value = 'b';
        $data = 'a:1:{s:1:"'. $key .'";s:1:"'.$value.'";}';
        $encoded = base64_encode($data);
        $this->assertSame(Encoded::getThingThatIsEncoded($encoded, $key), $value);
    }

    /**
     * @test
     * @group encoded
     * @group encoded-unpackJson
     */
    public function a_string_can_be_unpacked_from_json_string()
    {
        $arr = ['a' => 'b'];
        $data = json_encode($arr);
        $this->assertSame(Encoded::unpackJson($data), $arr);
    }

    /**
     * @test
     * @group encoded
     * @group encoded-unpackSerialized
     */
    public function a_string_can_be_unpacked_from_serialized_string()
    {
        $arr = ['a' => 'b'];
        $data = serialize($arr);
        $this->assertSame(Encoded::unpackSerialized($data), $arr);
    }

    /**
     * @test
     * @group encoded
     * @group encoded-getThingThatIsEncoded
     */
    public function it_will_return_the_string_if_incorrectly_formatted()
    {
        $arr = ['a' => 'b'];
        $data = md5(json_encode($arr));
        $this->assertSame(Encoded::getThingThatIsEncoded($data, 'a'), $data);
    }

    /**
     * @test
     * @group encoded
     * @group encoded-getThingThatIsEncoded
     */
    public function it_will_return_the_string_if_formatted_correctly_but_the_key_does_not_exist()
    {
        $arr = ['a' => 'b'];
        $data = json_encode($arr);
        $this->assertSame(Encoded::getThingThatIsEncoded($data, 'b'), $data);
    }

    /**
     * A string string will return true if encoded by base64 function
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function a_string_string_will_return_true_if_encoded_by_base64_function()
    {
        $this->assertTrue(Encoded::isBase64(base64_encode(time())));
    }


    /**
     * The encoded type will return json if a string is a json encoded string
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function the_encoded_type_will_return_json_if_a_string_is_a_json_encoded_string()
    {
        $this->assertSame('json', Encoded::getEncodeType(json_encode([1,2,3,4,5])));
    }


    /**
     * The encoded type will return serialized if a string is a serialize encoded string
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function the_encoded_type_will_return_serialized_if_a_string_is_a_serialize_encoded_string()
    {
        $this->assertSame('serialized', Encoded::getEncodeType(serialize([1,2,3,4,5])));
    }


    /**
     * The encoded type will return base64 if a string is a base46 encoded string
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function the_encoded_type_will_return_base64_if_a_string_is_a_base46_encoded_string()
    {
        $this->assertSame('base64', Encoded::getEncodeType(base64_encode(time())));
    }

    /**
     * Test that decoding a base64 string return an expected value
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function test_that_decoding_a_base64_string_return_an_expected_value()
    {
        $string = 'Lorem ipsom';
        $base64Encoded = base64_encode($string);
        $this->assertSame($string, Encoded::unpackBase64($base64Encoded));

        $array = [1,2,3,4,5];
        $json = json_encode($array);
        $base64Encoded = base64_encode($json);
        $this->assertSame($json, Encoded::unpackBase64($base64Encoded));

        $serialized = serialize($array);
        $base64Encoded = base64_encode($serialized);
        $this->assertSame($serialized, Encoded::unpackBase64($base64Encoded));
    }

    /**
     * A string string will return false if not encoded by base64 function
     * @test
     * @group encodedIsBase64
     * @group encoded
     */
    public function a_string_string_will_return_false_if_not_encoded_by_base64_function()
    {
        $this->assertFalse(Encoded::isBase64(serialize([1,2,3,4,5])));
        $this->assertFalse(Encoded::isBase64(json_encode([1,2,3,4,5])));
    }
}
