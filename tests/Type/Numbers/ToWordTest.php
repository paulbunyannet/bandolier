<?php
namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;

class ToWordTest extends BandolierTestCase
{
    /**
     * @test
     */
    public function it_will_return_a_word_from_number()
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
    public function it_returns_a_word_if_number_is_a_string()
    {
        $this->assertSame(
            Numbers::toWord('123456789123.12345'),
            'one hundred and twenty-three billion, four hundred and fifty-six million, seven hundred and eighty-nine thousand, one hundred and twenty-three point one two three four five'
        );
    }

    /**
     * @test
     */
    public function it_will_return_false_if_number_is_not_numeric()
    {
        $this->assertFalse(Numbers::toWord('this is not a number'));
    }

    /**
     * @test
     * @expectedException \Pbc\Bandolier\Exception\Type\Numbers\OutOfRangeException
     */
    public function it_will_return_false_if_number_is_greater_than_max_int()
    {
        Numbers::toWord(PHP_INT_MAX + 1);
    }
}
