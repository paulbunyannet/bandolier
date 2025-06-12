<?php
namespace Tests\Type\String;

use Pbc\Bandolier\Type\Strings;
use PHPUnit\Framework\TestCase;

class SnakeTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnASnakeCasedString()
    {
        $this->assertEquals('bandolier_p_h_p_toolbox', Strings::snake('BandolierPHPToolbox'));
        $this->assertEquals('bandolier_php_toolbox',   Strings::snake('BandolierPhpToolbox'));
        $this->assertEquals('bandolier php toolbox',   Strings::snake('BandolierPhpToolbox', ' '));
        $this->assertEquals('bandolier_php_toolbox',   Strings::snake('Bandolier Php Toolbox'));
        $this->assertEquals('bandolier_php_toolbox',   Strings::snake('Bandolier         Php          Toolbox        '));
        // ensure cache keys don't overlap
        $this->assertEquals('bandolier__php__toolbox', Strings::snake('BandolierPhpToolbox', '__'));
        $this->assertEquals('bandolier_php_toolbox_',  Strings::snake('BandolierPhpToolbox_', '_'));
        $this->assertEquals('bandolier_php_toolbox',   Strings::snake('bandolier php toolbox'));
        $this->assertEquals('bandolier_php_tool_box',  Strings::snake('bandolier php ToolBox'));
    }
}
