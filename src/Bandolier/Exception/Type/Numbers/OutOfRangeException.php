<?php
namespace Pbc\Bandolier\Exception\Type\Numbers;

use Pbc\Bandolier\Exception\Exception;
use Pbc\Bandolier\Exception\ExceptionInterface;

class OutOfRangeException extends Exception implements ExceptionInterface {

    /**
     * @param string $message
     * @param int $code
     */
    public function __construct($message = '', $code = 0) {
        parent::__construct($message, $code);
        return $this;
    }
}
