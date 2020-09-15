<?php
/**
 * DivisibleTest
 *
 * Created 11/3/17 10:28 AM
 * Checking the divisiveness of numbers
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Tests\Type\Numbers;
use Pbc\Bandolier\Type\Numbers;
use Tests\BandolierTestCase;


class DivisibleTest extends BandolierTestCase
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
