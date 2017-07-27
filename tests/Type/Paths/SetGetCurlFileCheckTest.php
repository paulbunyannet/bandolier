<?php
/**
 * setGetCurlFileCheckTest
 * Tests for the getter/setter for Paths::curlCheckFile
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Paths
 */

namespace Type\Paths;

use Pbc\Bandolier\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

class SetGetCurlFileCheckTest extends BandolierTestCase
{

    /**
     * @test
     * @group SetGetCurlFileCheck
     */
    public function testSetGetCurlFileCheckUseDefault()
    {
        $paths = new Paths();
        $paths->setCurlCheckFile();
        $this->assertSame($paths->getCurlCheckFile(), Paths::CURL_CHECK_FILE);
    }

    /**
     * @test
     * @group SetGetCurlFileCheck
     */
    public function testSetGetCurlFileCheckUseValue()
    {
        $path = "/path/to/.file";
        $paths = new Paths();
        $paths->setCurlCheckFile($path);
        $this->assertSame($paths->getCurlCheckFile(), $path);
    }

}