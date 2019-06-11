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
    /*
     * Test title case string with default settings
     */
    public function testTitleCaseString()
    {

        $stringIn = "this-is-a-string";
        $stringOut = "This-Is-A-String";

        $this->assertEquals(Strings::titleCase($stringIn), $stringOut);

    }

    /*
     * Test title case string with default settings
     */
    public function testReturnCachedIfAlreadyProcessed()
    {

        $stringIn = "this-is-a-string";
        $stringOut = "This-Is-A-String";

        $this->assertEquals(Strings::titleCase($stringIn), $stringOut);
        // This one should be cached
        $this->assertEquals(Strings::titleCase($stringIn), $stringOut);

    }

    /**
     * test title case with custom delimiter
     */
    public function testTitleCaseWithCustomDelimiter()
    {

        $stringIn = "this|is|a|string";
        $stringOut = "This|Is|A|String";

        $this->assertEquals(Strings::titleCase($stringIn, ['|']), $stringOut);
        
    }

    /**
     * test title case with custom filter
     */
    public function testTitleCaseWithCustomFilterList()
    {

        $stringIn = "this is a string";
        $stringOut = "This is a string";

        $this->assertEquals(Strings::titleCase($stringIn, [' '], ['is', 'a', 'string']), $stringOut);
        
    }

    /**
     * @test
     */
    public function it_finds_an_uppercase_exception_string()
    {
        $stringIn = "THIS IS A STRING";
        $stringOut = "This IS A STRING";

        $this->assertSame(Strings::titleCase($stringIn, [' '], ['IS', 'A', 'STRING']), $stringOut);
    }

    /**
     * @test
     */
    public function testThatItWillReturnFalseIfInputIsNotAString()
    {
        $this->assertFalse(Strings::titleCase(['foo-bar']));
    }

    /**
     * @test
     */
    public function testThatItWillReturnFalseIfInputStringIsEmpty()
    {
        $this->assertFalse(Strings::titleCase(''));
    }
}
