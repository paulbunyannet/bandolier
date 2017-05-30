<?php
namespace Pbc\Bandolier;
/**
 * BandolierTestCase
 *
 * Created 9/12/15 2:56 PM
 * Bootstrap file for tests.
 *
 * @author Nate Nolting <me@natenolting.com>
 * @link https://github.com/paulbunyannet/bandolier
 * @package Bandolier
 * @subpackage Test
 */
/**
 * Class BandolierTestCase
 * @package Pbc\Bandolier
 */
abstract class BandolierTestCase extends \PHPUnit_Framework_TestCase
{

    /**
     * @var
     */
    protected static $faker;
    /**
     * @var
     */
    protected $characterChecks;
    /**
     * @var array
     */
    protected $specialCharacters = [
        '\'',
        '"',
        "!",
        "@",
        "#",
        "$",
        "%",
        "^",
        "&",
        "*",
        "(",
        ")",
        "[",
        "{",
        "]",
        "}",
        '|',
        "\\",
        ":",
        ":",
        ",",
        "<",
        ".",
        ">",
        "/",
        "?"
    ];

    /**
     *
     */
    protected function setUp()
    {
        parent::setUp();
        self::$faker = \Faker\Factory::create();

        $this->characterChecks = array_merge(
            range("a", "Z"),
            $this->specialCharacters
        );
    }

    /**
     *
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

}
