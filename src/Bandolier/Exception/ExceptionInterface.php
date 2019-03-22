<?php

namespace Pbc\Bandolier\Exception;

interface ExceptionInterface
{
    // Protected methods inherited from Exception class
    /**
     * Exception message
     * @return mixed
     */
    public function getMessage();

    /**
     * User-defined Exception code
     * @return mixed
     */
    public function getCode();

    /**
     * Source filename
     *
     * @return mixed
     */
    public function getFile();

    /**
     * Source line
     *
     * @return mixed
     */
    public function getLine();

    /**
     * An array of the backtrace()
     *
     * @return mixed
     */
    public function getTrace();

    /**
     * Formatted string of trace
     *
     * @return mixed
     */
    public function getTraceAsString();

    // Overrideable methods inherited from Exception class

    /**
     * formatted string for display
     *
     * @return mixed
     */
    public function __toString();

}
