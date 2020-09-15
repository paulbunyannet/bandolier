<?php

namespace Tests\Type\Paths;

use Pbc\Bandolier\Type\Paths;
use PHPUnit\Framework\TestCase;

class SetTest extends TestCase
{

	public function testSetDomainNameWeb()
	{
		$path = new Paths();
		$domainNameWeb = 'somesite.com';
		$path->setDomainNameWeb($domainNameWeb);
		$this->assertSame($domainNameWeb, $path->getDomainNameWeb());
	}
}
