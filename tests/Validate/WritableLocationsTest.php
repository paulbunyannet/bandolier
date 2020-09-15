<?php
namespace Tests\Validate;

use org\bovigo\vfs\content\LargeFileContent;
use Pbc\Bandolier\Exception\Writable\LocationDoesExist;
use Pbc\Bandolier\Exception\Writable\LocationIsADirectory;
use Pbc\Bandolier\Exception\Writable\LocationIsWritable;
use Pbc\Bandolier\Validate\WritableLocation;
use Tests\BandolierTestCase;
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
     */
    public function testThatALocationIsNotWritable()
    {
        $this->expectException(LocationIsWritable::class);
        $stream = vfsStream::setup('not_writable');
        $stream->chmod(0444);
        $writable = new WritableLocation(['path' => $stream->url()]);
    }

    /**
     * Test that a location is not writable
     *
     * @test
     */
    public function testThatALocationExists()
    {
        $this->expectException(LocationDoesExist::class);
        $writable = new WritableLocation(['path' => '/some/unknown/path']);
    }

    /**
     * Test that a location is not writable
     *
     * @test
     */
    public function testThatALocationIsADirectory()
    {
        $this->expectException(LocationIsADirectory::class);
        $stream = vfsStream::setup('not_a_directory');
        $file = vfsStream::newFile('large.txt')
            ->withContent(LargeFileContent::withKilobytes(10))
            ->at($stream);
        $writable = new WritableLocation(['path' => $file->url()]);
    }
}
