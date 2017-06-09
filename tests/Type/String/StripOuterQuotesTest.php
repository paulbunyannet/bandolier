<?php
/**
 * StripOuterQuotesTest
 *
 * Created 6/9/17 3:37 PM
 * Test the Strings::stripOuterQuotes
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\String
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;


class StripOuterQuotesTest extends BandolierTestCase
{


  /**
   * Test stripOuterQuotes Check that double quotes can be removed
   * @test testStripOuterQuotesCheckThatDoubleQuotesCanBeRemoved
   */
   public function testStripOuterQuotesCheckThatDoubleQuotesCanBeRemoved()
   {
        $value = self::$faker->md5;
        $string = '"'.$value.'"';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($value, $stripped);
   }


  /**
   * Test stripOuterQuotes Check that single quotes can be removed
   * @test testStripOuterQuotesCheckThatSingleQuotesCanBeRemoved
   */
   public function testStripOuterQuotesCheckThatSingleQuotesCanBeRemoved()
   {
        $value = self::$faker->md5;
        $string = '\''.$value.'\'';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($value, $stripped);
   }


  /**
   * Test stripOuterQuotes check that if thes start and end don't match but are still either a single or double quote they will be removed
   * @test testStripOuterQuotesCheckThatIfThesStartAndEndDonTMatchButAreStillEitherASingleOrDoubleQuoteTheyWillBeRemoved
   */
   public function testStripOuterQuotesCheckThatIfThesStartAndEndDonTMatchButAreStillEitherASingleOrDoubleQuoteTheyWillBeRemoved()
   {
        //start single end double
        $value = self::$faker->md5;
        $string = '\''.$value.'"';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($value, $stripped);

        //start double end single
        $value = self::$faker->md5;
        $string = '"'.$value.'\'';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($value, $stripped);
   }


  /**
   * Test stripOuterQuotes won't strip quotes if there's not a start or finish quote
   * @test testStripOuterQuotesWontStripQuotesIfTheresNotAStartOrFinishQuote
   */
   public function testStripOuterQuotesWontStripQuotesIfTheresNotAStartOrFinishQuote()
   {

        // front none and end double
        $value = self::$faker->md5;
        $string = $value.'"';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($string, $stripped);

        // front double and end none
        $value = self::$faker->md5;
        $string = '"'.$value;
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($string, $stripped);

        // front none and end single
        $value = self::$faker->md5;
        $string = $value.'\'';
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($string, $stripped);

        // front single and end none
        $value = self::$faker->md5;
        $string = '\''.$value;
        $stripped = Strings::stripOuterQuotes($string);
        $this->assertSame($string, $stripped);

   }

}
