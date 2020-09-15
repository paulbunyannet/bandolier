<?php
namespace Tests\Type\Numbers;


/**
 * ToFloatTest
 *
 * Created 3/29/16 4:52 PM
 * Tests for the Number::toFloat() method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

use Pbc\Bandolier\Type\Numbers;
use Tests\BandolierTestCase;

class ToFloatTest extends BandolierTestCase
{

    /**
     * @test
     */
    public function a_string_number_will_return_a_float()
    {
        $this->assertSame(1.25, Numbers::toFloat('1.25'));
        $this->assertSame(1.25, Numbers::toFloat('$1.25'));
        $this->assertSame(1000.25, Numbers::toFloat('$1,000.25'));
        $this->assertSame(1000000.25, Numbers::toFloat('$1,000,000.25'));
        $this->assertSame(100.25, Numbers::toFloat('abc100def.25xyz'));
    }

    /**
     * @test
     */
    public function a_integer_will_return_as_a_float()
    {
        $this->assertSame(125.0, Numbers::toFloat('125'));
    }
}
