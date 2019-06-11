<?php
/**
 * ${CLASS_NAME}
 *
 * Created 10/23/18 1:16 PM
 * Description of this file here....
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type\Html
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type\Html;


class SpecialCharacterTest extends \PHPUnit_Framework_TestCase
{

    public function testSuperscriptSpecialCharacters()
    {
        $string = "This® Thing™ is©";
        $stringAfter = "This<sup>®</sup> Thing<sup>™</sup> is<sup>©</sup>";

        $this->assertSame($stringAfter, SpecialCharacter::superscriptSpecialCharacters($string));
    }
}
