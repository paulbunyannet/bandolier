<?php

namespace Type\Paths;

use Pbc\Bandolier\Type\Paths;

class SetTest extends \PHPUnit_Framework_TestCase
{

	public function testSetDomainNameWeb()
	{
		$path = new Paths();
		$domainNameWeb = 'somesite.com';
		$path->setDomainNameWeb($domainNameWeb);
		$this->assertSame($domainNameWeb, $path->getDomainNameWeb());
	}
}
