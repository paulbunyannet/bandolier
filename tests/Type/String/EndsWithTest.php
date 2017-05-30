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
class EndsWithTest extends BandolierTestCase
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
     * Check that endsWith returns true if string does end with character
     */
    public function testEndsWithReturnsTrueIfStringEndsWithCharacter()
    {
        $word = self::$faker->word;

        foreach ($this->characterChecks as $check) {
            $this->assertTrue(Strings::endsWith($word . $check, $check));
        }
    }

    /**
     * Check that endsWith returns false if string does not end with character
     */
    public function testEndsWithReturnsFalseIfStringDoesNotEndWithCharacter()
    {
        $word = self::$faker->word . 'A';

        foreach ($this->specialCharacters as $check) {
            $this->assertFalse(Strings::endsWith($word, $check));
        }
    }

    /**
     * Check that an exception is thrown if needle is zero length
     * @expectedException     \Exception
     * @expectedExceptionMessage Needle must be one or more characters
     */
    public function testEndsWithWillThrowAnExceptionIfTheNeedleHasAStringLengthOfZero()
    {
        $word = self::$faker->word;
        Strings::endsWith($word, null);
    }
}
