<?php
/**
 * stripSlashes Tests
 *
 * Created 9/12/15 3:03 PM
 * Tests for String methods
 *
 * @author Nate Nolting <me@natenolting.com>
 * @package Pbc\Bandolier\Tests\Type
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\BandolierTestCase;

/**
 * Class StringsTest
 * @package Pbc\Bandolier\Type
 */
class StripSlashesTest extends BandolierTestCase
{

    /**
     * Strip off
     */
    public function testStripSlashesExtraEscapedDoubleQuote()
    {
        $string = '"String with escaped quotes\\\"';
        $stringStripped = '"String with escaped quotes"';

        $this->assertEquals($stringStripped, Strings::stripSlashes($string));
    }

    /**
     * Strip off double escaped single quites, like 'String with escaped quotes\\'
     */
    public function testStripSlashesExtraEscapedSingle()
    {
        $string = "'String with escaped quotes\\'";
        $stringStripped = "'String with escaped quotes'";

        $this->assertEquals($stringStripped, Strings::stripSlashes($string));
    }

    /**
     * Strop off triple escaped single quotes, like 'String with escaped quotes\\\'
     */
    public function testStripSlashesTripleEscapedSingleQuote()
    {
        $string = "'String with escaped quotes\\\'";
        $stringStripped = "'String with escaped quotes'";

        $this->assertEquals($stringStripped, Strings::stripSlashes($string));
    }

    /**
     * Test stripping off triple escaped quotes, such as "String with escaped quotes\\\"
     */
    public function testStripSlashesTripleEscapedDoubleQuote()
    {
        $string = '"String with escaped quotes\\\"';
        $stringStripped = '"String with escaped quotes"';

        $this->assertEquals
        ($stringStripped, Strings::stripSlashes($string));
    }
}
