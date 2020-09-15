<?php

/**
 * GetDirContentsTest
 *
 * Created 9/30/15 4:27 PM
 * Tests for the getDirContents method
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */


namespace Tests\Type\File;

use Pbc\Bandolier\Type\File;
use Tests\BandolierTestCase;

class GetDirContentsTest extends BandolierTestCase
{
    protected $fileName;
    protected $fileDirectory;
    protected $fileSubDirectory;

    /**
     * Setup test fixtures
     */
    public function setUp() : void
    {
        $this->fileName = md5(microtime(true)) . '.txt';
        $this->fileDirectory = 'fixture_directory';
        $this->fileSubDirectory = 'fixture_sub_directory';

        if(!file_exists(__DIR__ . '/'.$this->fileDirectory)) {
            mkdir(__DIR__ . '/' . $this->fileDirectory);
        }

        if(!file_exists(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory)) {

            mkdir(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory);
        }

        file_put_contents(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory . '/'.$this->fileName, microtime(true));

    }

    /**
     * tear down the test fixtures
     */
    public function tearDown() : void
    {
        unlink(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory . '/'.$this->fileName);
        rmdir(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory);
        rmdir(__DIR__ . '/'.$this->fileDirectory);

    }

    /**
     * Can we see a file in a sub directory?
     */
    public function testCanSeeFileInSubDirectory()
    {
        $files = File::getDirContents(__DIR__ . '/'. $this->fileDirectory);
        $this->assertContains(__DIR__ . '/' .$this->fileDirectory . '/' . $this->fileSubDirectory . '/'.$this->fileName, $files);
    }

}
