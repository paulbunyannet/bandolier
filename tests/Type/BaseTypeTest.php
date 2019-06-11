<?php

use Pbc\Bandolier\Type\BaseType;

class BaseTypeTest extends PHPUnit_Framework_TestCase
{

	/**
	 * @test
	 * @group BaseType
	 * @expectedException \Pbc\Bandolier\Type\Collection\Exception\KeyInvalidException
	 */
	public function testBaseTypeWillThrowExceptionIfClassFieldDoesNotExist()
	{
		new \Pbc\Bandolier\Type\Arrays(['non_existant_field' => 'foo']);
	}

}
