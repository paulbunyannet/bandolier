<?php
namespace Tests\Type\String;

use Pbc\Bandolier\Type\Strings;
use PHPUnit\Framework\TestCase;

class CamelTest extends TestCase
{
    /**
     * @test
     */
    public function it_return_a_camel_cased_string()
    {
        $this->assertEquals('bandolierPHPToolbox', Strings::camel('bandolier_p_h_p_toolbox'));
        $this->assertEquals('bandolierPhpToolbox', Strings::camel('bandolier_php_toolbox'));
        $this->assertEquals('bandolierPhPToolbox', Strings::camel('bandolier-phP-toolbox'));
        $this->assertEquals('bandolierPhpToolbox', Strings::camel('bandolier  -_-  php   -_-   toolbox   '));    }
}
