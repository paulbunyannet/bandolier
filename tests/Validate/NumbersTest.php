<?php
/**
 * NumbersTest
 *
 * Created 11/3/17 10:46 AM
 * Validate the divisiveness of a number
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Validate
 * @subpackage Subpackage
 */

namespace Tests\Validate;
use Pbc\Bandolier\Validate\Numbers;
use Tests\BandolierTestCase;

class NumbersTest extends BandolierTestCase
{

    /**
     * Test that numbers that are divisible return true
     * @test
     * @group numbers
     */
    public function testThatNumbersThatAreDivisibleReturnTrue()
    {
        $list = [
            6 => 2,
            9 => 3,
            10 => 5,
            24 => 8,
            100 => 10,
        ];

        foreach ($list as $key => $val) {
            $this->assertTrue(Numbers::divisible($key, $val), $key . ' is divisible by '. $val);
        }
    }

    /**
     * Test that numbers that are not divisible return false
     * @test
     * @group numbers
     */
    public function testThatNumbersThatAreNotDivisibleReturnFalse()
    {
        $list = [
            7 => 2,
            10 => 3,
            11 => 5,
            25 => 8,
            101 => 10,
        ];

        foreach ($list as $key => $val) {
            $this->assertFalse(Numbers::divisible($key, $val), $key . ' is not divisible by '. $val);
        }
    }

}
