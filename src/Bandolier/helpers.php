<?php
use Pbc\Bandolier\Type\Strings;

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     * Borrowed from Illuminate/Foundation
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
            case '"true"':
                return true;
            case 'false':
            case '(false)':
            case '"false"':
                return false;
            case 'empty':
            case '(empty)':
            case '"empty"':
                return '';
            case 'null':
            case '(null)':
            case '"null"':
                return;
        }

        if (strlen($value) > 1 && Strings::startsWith($value, '"') && Strings::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed  $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}