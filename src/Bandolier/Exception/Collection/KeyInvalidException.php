<?php
/**
 * KeyInvalidException
 *
 * Created 6/9/17 12:44 PM
 * Exception handler for invalid keys from collection
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type\Collection\Exception
 */

namespace Pbc\Bandolier\Exception\Collection;

use Pbc\Bandolier\Exception\Exception;
use Pbc\Bandolier\Exception\ExceptionInterface;

class KeyInvalidException extends Exception implements ExceptionInterface {

    /**
     * @param string $message
     * @param int $code
     * @return void
     */
    public function __construct($message = '', $code = 0) {
        parent::__construct($message, $code);
    }
}
