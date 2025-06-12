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
   public function testItReturnsAFloatFromAWord()
   {
       $this->assertEquals(10.0, Strings::wordsToNumber('ten'));
       $this->assertEquals(100.0, Strings::wordsToNumber('one hundred'));
       $this->assertEquals(1101.0, Strings::wordsToNumber('one thousand one hundred and one'));
       $this->assertEquals(1100101.0, Strings::wordsToNumber('one million one hundred thousand one hundred and one'));
   }
    /**
      * It returns a false value if the value passed is empty
      * @test
      * @group wordsToNumber
      */
    public function testItReturnsAFalseValueIfTheValuePassedIsEmpty()
    {
        $this->assertFalse(Strings::wordsToNumber(""));
    }
}
