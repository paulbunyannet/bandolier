<?php
/**
 * FileGetContentsTest
 *
 * Tests for the Paths::fileGetContents() method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Type\Paths
 * @subpackage Subpackage
 */

namespace Type\Paths;

use Mockery as m;
use Pbc\Bandolier\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

class RmDirTest extends BandolierTestCase
{
    protected $root;
    protected $filePath;

    /**
     * Setup the test
     */
    public function setUp()
    {
        parent::setUp();
        $this->root = dirname(dirname(dirname(__DIR__))) . '/tmp/';
        $root = $this->root;
        $paths = BandolierTestCase::$faker->words(5);
        $file = __FUNCTION__ . '.txt';
        $content = BandolierTestCase::$faker->paragraph();
        $this->filePath = implode(DIRECTORY_SEPARATOR, $paths) . DIRECTORY_SEPARATOR . $file;
        $path = $root . $this->filePath;
        Paths::filePutContents($path, $content);

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
     * Test removing a directory that is not empty
     * @test
     * @group RmDir
     */
    public function testRemovingADirectoryThatIsNotEmpty()
    {
        $path = explode(DIRECTORY_SEPARATOR, $this->filePath);
        $folder = $this->root . $path[0];
        $this->assertTrue(Paths::rmDir($folder));
        $this->assertFileNotExists($this->root . $this->filePath);
    }


    /**
     * Test removing a directory returns true if folder doesn't exist in the first place
     * @test
     * @group RmDir
     */
    public function testRemovingADirectoryReturnsTrueIfFolderDoesnTExistInTheFirstPlace()
    {

        $this->assertTrue(Paths::rmDir(implode(DIRECTORY_SEPARATOR, BandolierTestCase::$faker->words(5))));
    }

}
