<?php
/**
 * FilePutContentsTest
 *
 * Created 10/10/17 10:31 AM
 * Tests for the filePutContents helper
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Bandolier\Type
 */

namespace Bandolier\Type;

use Mockery as m;
use Pbc\Bandolier\Type\Paths;
use Pbc\Bandolier\BandolierTestCase;

class FilePutContentsTest extends BandolierTestCase
{

    /**
     * Setup the test
     */
    public function setUp()
    {
        parent::setUp();

    }

    /**
     * Tear down the test
     */
    public function tearDown()
    {
        parent::tearDown();
        m::close();
    }

    /**
     * Test that we can make a file in a folder that does not exist
     * @test
     * @group FilePutContents
     */
    public function testThatWeCanMakeAFileInAFolderThatDoesNotExist()
    {
        $root = dirname(dirname(dirname(__DIR__))) . '/tmp/';
        $paths = BandolierTestCase::$faker->words(5);
        $file = __FUNCTION__ . '.txt';
        $content = BandolierTestCase::$faker->paragraph();
        $path = $root . implode(DIRECTORY_SEPARATOR, $paths) . DIRECTORY_SEPARATOR . $file;
        $put = Paths::filePutContents($path, $content);

        $this->assertNotFalse($put);
        $this->assertFileExists($path);
        $this->assertSame($content, file_get_contents($path));
    }

    /**
     * Test that a file will be written if the containing folder already exists
     * @test
     * @group FilePutContents
     */
    public function testFilePutContentsWillUseAnExistingFolderToWriteTo()
    {
        $root = dirname(dirname(dirname(__DIR__))) . '/tmp/';
        $file = __FUNCTION__ . BandolierTestCase::$faker->word . '.txt';
        $content = BandolierTestCase::$faker->paragraph();
        $path = $root . $file;
        $put = Paths::filePutContents($path, $content);

        $this->assertNotFalse($put);
        $this->assertFileExists($path);
        $this->assertSame($content, file_get_contents($path));

    }
}
