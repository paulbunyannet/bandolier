<?php

namespace Pbc\Bandolier\Exception;

interface ExceptionInterface extends \Throwable
{
    public function __construct(string $message = "", int $code = 0, ?\Throwable $previous = null);
}
