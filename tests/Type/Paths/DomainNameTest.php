<?php

namespace Type\Paths;

use Pbc\Bandolier\BandolierTestCase;
use Pbc\Bandolier\Type\Paths;

/**
 * Class DomainNameTest
 * @package Type\Paths
 */
class DomainNameTest extends BandolierTestCase
{

	/**
	 * @test
	 * @group PathsGetDomainFromString
	 */
	public function testSettingTheDoMainNameWebValue()
	{
		$url = "https://www.google.com/doodles";
		$path = new Paths();
		$path->setDomainNameWeb($url);
		$this->assertSame($url, $path->getDomainNameWeb());
	}
}
