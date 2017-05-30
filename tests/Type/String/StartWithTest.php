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
class StartWithTest extends BandolierTestCase
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
     * Check that startsWith returns true if string does start with character
     */
    public function testStarsWithReturnsTrueIfStringStartsWithCharacter()
    {
        $word = self::$faker->word;

        foreach ($this->characterChecks as $check) {
            $this->assertTrue(Strings::startsWith($check . $word, $check));
        }
    }

    /**
     * Check that startsWith returns false if string does not start with character
     */
    public function testStarsWithReturnsFalseIfStringDoesNotStartWithCharacter()
    {
        $word = 'A' . self::$faker->word;

        foreach ($this->specialCharacters as $check) {
            $this->assertFalse(Strings::startsWith($word, $check));
        }
    }
}
