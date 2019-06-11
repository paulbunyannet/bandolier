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
     * Test that a cached version of the string will be returned if already formatted
     */
    public function testReturnCachedIfAlreadyProcessed()
    {
        $stringIn = "this_is_a_string";
        $stringOut = "This Is A String";

        $this->assertEquals(Strings::formatForTitle($stringIn), $stringOut);
        // this one should be from the cache
        $this->assertEquals(Strings::formatForTitle($stringIn), $stringOut);
    }


    /**
     * test format for title will return false if empty string
     */
    public function testFormatStringFalseWithEmptyString()
    {
        $this->assertFalse(Strings::formatForTitle(""));
        $this->assertFalse(Strings::formatForTitle(null));
        $this->assertFalse(Strings::formatForTitle(false));
    }

    /**
     * Test that format for title will return false if not a string
     */
    public function testFormatStringFalseWithNonString()
    {
        $this->assertFalse(Strings::formatForTitle([]));
        $this->assertFalse(Strings::formatForTitle(new \stdClass()));
    }


}
