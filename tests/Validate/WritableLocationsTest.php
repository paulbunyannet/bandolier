<?php
namespace Pbc\Bandolier\Validate;

use org\bovigo\vfs\content\LargeFileContent;
use Pbc\Bandolier\BandolierTestCase;
use org\bovigo\vfs\vfsStream;

class WritableLocationsTest extends BandolierTestCase
{
    protected $stream;

    /**
     * Test that a location is writable
     * @test
     * @throws \Pbc\Bandolier\Exception\Writable\WritableLocation
     */
    public function testThatALocationIsWritable()
    {
      $stream = vfsStream::setup('writable');
      $stream->chmod(0777);
      $writable = new WritableLocation(['path' => $stream->url()]);
      $this->assertInstanceOf(WritableLocation::class, $writable);
    }

    /**
     * Test that a location is not writable
     *
     * @test
     * @expectedException \Pbc\Bandolier\Exception\Writable\LocationIsWritable
     */
    public function testThatALocationIsNotWritable()
    {
        $stream = vfsStream::setup('not_writable');
        $stream->chmod(0444);
        $writable = new WritableLocation(['path' => $stream->url()]);
    }

    /**
     * Test that a location is not writable
     *
     * @test
     * @expectedException \Pbc\Bandolier\Exception\Writable\LocationDoesExist
     */
    public function testThatALocationExists()
    {
        $writable = new WritableLocation(['path' => '/some/unknown/path']);
    }

    /**
     * Test that a location is not writable
     *
     * @test
     * @expectedException \Pbc\Bandolier\Exception\Writable\LocationIsADirectory
     */
    public function testThatALocationIsADirectory()
    {
        $stream = vfsStream::setup('not_a_directory');
        $file = vfsStream::newFile('large.txt')
            ->withContent(LargeFileContent::withKilobytes(10))
            ->at($stream);
        $writable = new WritableLocation(['path' => $file->url()]);
    }
}
