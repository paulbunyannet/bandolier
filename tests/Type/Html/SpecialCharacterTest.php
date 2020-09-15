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

namespace Tests\Type\Html;


use Pbc\Bandolier\Type\Html\SpecialCharacter;
use PHPUnit\Framework\TestCase;

class SpecialCharacterTest extends TestCase
{

    public function testSuperscriptSpecialCharacters()
    {
        $string = "This® Thing™ is©";
        $stringAfter = "This<sup>®</sup> Thing<sup>™</sup> is<sup>©</sup>";

        $this->assertSame($stringAfter, SpecialCharacter::superscriptSpecialCharacters($string));
    }
}
