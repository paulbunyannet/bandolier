<?php
/**
 * StartWithTest
 *
 * Created 5/30/17 9:36 AM
 * Tests for the startsWith method in Strings
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;

/**
 * Class StartWithTest
 * @package Pbc\Bandolier\Type
 */
class ContainsTest extends BandolierTestCase
{

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();

    }

    /**
     *
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Check that a string can be found in string if case sensitive
     */
    public function testStringIsFoundIfCaseSensitive()
    {
        $needle = "Foo";
        $haystack = $needle . " Bar";
        $this->assertTrue(Strings::contains($haystack, $needle, true));
    }

    /**
     * Check that a string can not be found in string if case sensitive
     */
    public function testStringIsNotFoundIfCaseSensitive()
    {
        $needle = "Foo";
        $haystack =  "Bar Baz";
        $this->assertFalse(Strings::contains($haystack, $needle, true));
    }

    /**
     * Check that a string can be found in string if case insensitive
     */
    public function testStringIsFoundIfCaseInsensitive()
    {
        $needle = "foo";
        $haystack = ucfirst($needle) . " Bar";
        $this->assertTrue(Strings::contains($haystack, $needle, false));
    }

    /**
     * Check that a string can not be found in string if case insensitive
     */
    public function testStringIsNotFoundIfCaseInsensitive()
    {
        $needle = "foo";
        $haystack =  "Bar Baz";
        $this->assertFalse(Strings::contains($haystack, $needle, false));
    }
}
