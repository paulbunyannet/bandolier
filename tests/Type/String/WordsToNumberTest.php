<?php
namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;

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
}
