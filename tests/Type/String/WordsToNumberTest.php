<?php
namespace Tests\Type\String;

use Pbc\Bandolier\Type\Strings;
use Tests\BandolierTestCase;

class WordsToNumberTest extends BandolierTestCase
{
   /**
    * @test
    * @group wordsToNumber
    */
   public function it_returns_a_float_from_a_word()
   {
       $this->assertEquals(10.0, Strings::wordsToNumber('ten'));
       $this->assertEquals(100.0, Strings::wordsToNumber('one hundred'));
       $this->assertEquals(1101.0, Strings::wordsToNumber('one thousand one hundred and one'));
       $this->assertEquals(1100101.0, Strings::wordsToNumber('one million one hundred thousand one hundred and one'));
   }

   /**
    * @test
    * @group wordsToNumber
    */
   public function testReturnCachedIfAlreadyProcessed()
   {
       $this->assertEquals(10.0, Strings::wordsToNumber('ten'));
       // This should be the cached version
       $this->assertEquals(10.0, Strings::wordsToNumber('ten'));

   }

    /**
     * It returns a false value if the value passed is empty
     * @test
     * @group wordsToNumber
     */
    public function it_returns_a_false_value_if_the_value_passed_is_empty()
    {
        $this->assertFalse(Strings::wordsToNumber(""));
    }
}
