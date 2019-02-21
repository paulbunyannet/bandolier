<?php
namespace Pbc\Bandolier\Exception\Writable;

class LocationIsWritable extends WritableLocation {

	/**
	 * @param string $message
	 * @param int $code
	 */
	public function __construct($message = '', $code = 0) {
		parent::__construct($message, $code);
		return $this;
	}
}
