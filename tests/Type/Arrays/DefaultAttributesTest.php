<?php
namespace Pbc\Bandolier\Type;

/**
 * ArraysTest
 *
 * Created 10/24/16 10:03 PM
 * Tests for Arrays::DefaultAttributes method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

use Pbc\Bandolier\BandolierTestCase;

class DefaultAttributesTest extends BandolierTestCase
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
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test that when passing a second array with the same key that the second value will be returned.
     * @test
     * @group arrays
     * @group arrays-defaultAttributes
     */
    public function default_array_will_be_overwritten_if_collision_is_found()
    {
        $array1 = ['a' => '123'];
        $array2 = ['a' => '345'];

        $default = Arrays::defaultAttributes($array1, $array2);
        $this->assertSame($default['a'], $array2['a']);
    }

    /**
     * Test that when passing a second array with different keys that the first value will be returned.
     * @test
     * @group arrays
     * @group arrays-defaultAttributes
     */
    public function default_array_will_be_used_if_no_collision_is_found()
    {
        $array1 = ['a' => '123'];
        $array2 = ['b' => '345'];

        $default = Arrays::defaultAttributes($array1, $array2);
        $this->assertSame($default['a'], $array1['a']);
    }
}
