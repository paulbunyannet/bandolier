<?php
/**
 * TitleCaseTest
 *
 * Created 10/13/15 4:52 PM
 * Test title case method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Test
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;


/**
 * Class TitleCaseTest
 * @package Pbc\Bandolier\Type
 */
class TitleCaseTest extends BandolierTestCase
{

    /**
     * Test title case string with default settings
     */
    public function testTitleCaseString()
    {

        $stringIn = "this-is-a-string";
        $stringOut = "This-Is-A-String";

        $this->assertEquals(Strings::titleCase($stringIn), $stringOut);

    }

    /**
     * test title case with custom delimiter
     */
    public function testTitleCaseWithCustomDelimiter()
    {

        $stringIn = "this|is|a|string";
        $stringOut = "This|Is|A|String";

        $this->assertEquals(Strings::titleCase($stringIn,['|']), $stringOut);


    }

    /**
     * test title case with custom filter
     */
    public function testTitleCaseWithCustomFilterList()
    {

        $stringIn = "this is a string";
        $stringOut = "This is a string";

        $this->assertEquals(Strings::titleCase($stringIn,[' '],['is','a','string']), $stringOut);


    }


}
