<?php
namespace Tests;

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
use Faker\Factory;
use PHPUnit\Framework\TestCase;

/**
 * Class BandolierTestCase
 * @package Pbc\Bandolier
 */
abstract class BandolierTestCase extends TestCase
{

    /**
     * @var \Faker\Generator
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
    protected function setUp() : void
    {
        parent::setUp();
        self::$faker = Factory::create();

        $this->characterChecks = array_merge(
            range("a", "Z"),
            $this->specialCharacters
        );
    }
}
