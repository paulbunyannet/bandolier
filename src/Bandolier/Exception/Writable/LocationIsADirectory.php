<?php
namespace Pbc\Bandolier\Exception\Writable;

class LocationIsADirectory extends WritableLocation {

    /**
     * @param string $message
     * @param int $code
     * @return void
     */
    public function __construct($message = '', $code = 0) {
        parent::__construct($message, $code);
    }
}
