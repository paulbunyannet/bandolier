<?php

namespace Tests\Type\Paths;

use Tests\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

/**
 * Class DomainFromStringTest
 * @package Type\Paths
 */
class DomainFromStringTest extends BandolierTestCase
{

	/**
	 * @test
	 * @group PathsGetDomainFromString
	 */
	public function testGettingTheDomainFromAString()
	{
		$url = "https://www.google.com/doodles";
		$this->assertSame('google.com', Paths::domainFromString($url));
	}

	/**
	 * @test
	 * @group PathsGetDomainFromString
	 */
	public function testGettingTheDomainFromAStringIsFalse()
	{
		$url = "Something that is not a url";
		$this->assertFalse(Paths::domainFromString($url));
	}

}
