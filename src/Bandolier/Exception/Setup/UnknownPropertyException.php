<?php
namespace Pbc\Bandolier\Exception\Setup;

use Pbc\Bandolier\Exception\Exception;
use Pbc\Bandolier\Exception\ExceptionInterface;

class UnknownPropertyException extends Exception implements ExceptionInterface {

    /**
     * @param string $message
     * @param int $code
     * @return void
     */
    public function __construct($message = '', $code = 0) {
        parent::__construct($message, $code);
    }
}