<?php
/**
 * FormatForTitleTest
 *
 * Created 10/13/15 4:45 PM
 * Test format for title method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Tests
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;


/**
 * Class FormatForTitleTest
 * @package Pbc\Bandolier\Type
 */
class FormatForTitleTest extends BandolierTestCase
{

    /**
     * check return of format for title
     */
    public function testFormatStringWithDelimeter()
    {
        $stringIn = "this_is_a_string";
        $stringOut = "This Is A String";

        $this->assertEquals(Strings::formatForTitle($stringIn), $stringOut);
    }


    /**
     * test format for title will return false if empty string
     */
    public function testFormatStringFalseWithEmptyString()
    {
        $string = '';
        $this->assertFalse(Strings::formatForTitle($string));
    }

    /**
     * Test that format for title will return false if not a string
     */
    public function testFormatStringFalseWithNonString()
    {
        $string = [];
        $this->assertFalse(Strings::formatForTitle($string));
    }


}
