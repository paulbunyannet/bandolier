<?php
namespace Pbc\Bandolier\Type;

class StudlyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_return_a_studly_cased_string()
    {
        $this->assertEquals('BandolierPHPToolbox', Strings::studly('bandolier_p_h_p_toolbox'));
        $this->assertEquals('BandolierPhpToolbox', Strings::studly('bandolier_php_toolbox'));
        $this->assertEquals('BandolierPhPToolbox', Strings::studly('bandolier-phP-toolbox'));
        $this->assertEquals('BandolierPhpToolbox', Strings::studly('bandolier  -_-  php   -_-   toolbox   '));    }
}
