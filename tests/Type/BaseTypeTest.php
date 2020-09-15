<?php

namespace Tests\Type;

use Pbc\Bandolier\Exception\Collection\KeyInvalidException;
use Pbc\Bandolier\Type\Arrays;
use PHPUnit\Framework\TestCase;

class BaseTypeTest extends TestCase
{

	/**
	 * @test
	 * @group BaseType
	 */
	public function testBaseTypeWillThrowExceptionIfClassFieldDoesNotExist()
	{
	    $this->expectException(KeyInvalidException::class);
		new Arrays(['non_existant_field' => 'foo']);
	}

}
