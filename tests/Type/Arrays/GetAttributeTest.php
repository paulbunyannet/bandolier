<?php
namespace Tests\Type\Arrays;

/**
 * ArraysTest
 *
 * Created 10/24/16 10:03 PM
 * Tests for Arrays::Attributes method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

use Pbc\Bandolier\Type\Arrays;
use Tests\BandolierTestCase;

class GetAttributeTest extends BandolierTestCase
{
    /**
     * @test
     * @group ArrayGetAttribute
     */
    public function testArrayGetAttributeCanFindKeyInArray()
    {
        $value = 'foo';
        $key = 'bar';
        $data = [$key => $value];
        $this->assertSame($value, Arrays::getAttribute($data, $key));
    }

    /**
     * @test
     * @group ArrayGetAttribute
     */
    public function testArrayGetAttributeWillReturnNullIfNoDefaultIsSetAndTheKeyIsNotFoundInArray()
    {
        $value = 'foo';
        $key = 'bar';
        $data = [$key => $value];
        $this->assertNull(Arrays::getAttribute($data, 'bazz'));
    }

    /**
     * @test
     * @group ArrayGetAttribute
     */
    public function testArrayGetAttributeWillReturnDefaultIfKeyIsNotFound()
    {
        $value = 'foo';
        $key = 'bar';
        $default = 'bin';
        $data = [$key => $value];
        $this->assertSame($default, Arrays::getAttribute($data, 'bazz', $default));
    }
    /**
     * @test
     * @group ArrayGetAttribute
     */
    public function testArrayGetAttributeWillReturnDefaultIfKeyIsNotSet()
    {
        $value = 'foo';
        $key = 'bar';
        $default = 'bin';
        $data = [$key => $value];
        $this->assertSame($default, Arrays::getAttribute($data, null, $default));
    }
}
