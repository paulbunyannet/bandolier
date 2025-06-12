<?php
namespace Tests\Type\Numbers;

use Pbc\Bandolier\Exception\Type\Numbers\OutOfRangeException;
use Pbc\Bandolier\Type\Numbers;
use Tests\BandolierTestCase;

class ToWordTest extends BandolierTestCase
{
    /**
     * @test
     */
    public function testItWillReturnAWordFromNumber()
    {
        $this->assertSame(
            Numbers::toWord(123456789),
            'one hundred and twenty-three million, four hundred and fifty-six thousand, seven hundred and eighty-nine'
        );

        $this->assertSame(
            Numbers::toWord(123456789.123),
            'one hundred and twenty-three million, four hundred and fifty-six thousand, seven hundred and eighty-nine point one two three'
        );

        $this->assertSame(
            Numbers::toWord(-1922685.477),
            'negative one million, nine hundred and twenty-two thousand, six hundred and eighty-five point four seven seven'
        );
    }

    /**
     * @test
     */
    public function testItReturnsAWordIfNumberIsAString()
    {
        $this->assertSame(
            Numbers::toWord('123456789123.12345'),
            'one hundred and twenty-three billion, four hundred and fifty-six million, seven hundred and eighty-nine thousand, one hundred and twenty-three point one two three four five'
        );
    }

    /**
     * @test
     */
    public function testItWillReturnFalseIfNumberIsNotNumeric()
    {
        $this->assertFalse(Numbers::toWord('this is not a number'));
    }

    /**
     * @test
     */
    public function testItWillReturnFalseIfNumberIsGreaterThanMaxInt()
    {
        $this->expectException(OutOfRangeException::class);
        Numbers::toWord(PHP_INT_MAX + 1);
    }
}
