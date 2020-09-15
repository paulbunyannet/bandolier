<?php
namespace Tests\Type\String;

use Pbc\Bandolier\Type\Strings;
use PHPUnit\Framework\TestCase;

class KabobTest extends TestCase
{
    /**
     * @test
     */
    public function it_return_a_kebab_cased_string()
    {
        $this->assertEquals('bandolier-p-h-p-toolbox', Strings::kebab('BandolierPHPToolbox'));
        $this->assertEquals('bandolier-php-toolbox',   Strings::kebab('BandolierPhpToolbox'));
        $this->assertEquals('bandolier-php-toolbox',   Strings::kebab('Bandolier Php Toolbox'));
        $this->assertEquals('bandolier-php-toolbox',   Strings::kebab('Bandolier         Php          Toolbox        '));
        // ensure cache keys don't overlap
        $this->assertEquals('bandolier-php-toolbox', Strings::kebab('BandolierPhpToolbox'));
        $this->assertEquals('bandolier-php-toolbox_',  Strings::kebab('BandolierPhpToolbox_'));
        $this->assertEquals('bandolier-php-toolbox',   Strings::kebab('bandolier php toolbox'));
        $this->assertEquals('bandolier-php-tool-box',  Strings::kebab('bandolier php ToolBox'));
    }
}
