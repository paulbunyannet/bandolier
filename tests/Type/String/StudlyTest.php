<?php
namespace Tests\Type\String;

use Pbc\Bandolier\Type\Strings;
use PHPUnit\Framework\TestCase;

class StudlyTest extends TestCase
{
    /**
     * @test
     */
    public function testItReturnAStudlyCasedString()
    {
        $this->assertEquals('BandolierPHPToolbox', Strings::studly('bandolier_p_h_p_toolbox'));
        $this->assertEquals('BandolierPhpToolbox', Strings::studly('bandolier_php_toolbox'));
        $this->assertEquals('BandolierPhPToolbox', Strings::studly('bandolier-phP-toolbox'));
        $this->assertEquals('BandolierPhpToolbox', Strings::studly('bandolier  -_-  php   -_-   toolbox   '));    }
}
