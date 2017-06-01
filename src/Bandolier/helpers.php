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

        $conditions = [
            ['return' => true, 'checks' => ['true', '(true)', '"true"']],
            ['return' => false, 'checks' => ['false', '(false)', '"false"']],
            ['return' => null, 'checks' => ['null', '(null)', '"null"']],
            ['return' => '', 'checks' => ['empty', '(empty)', '"empty"']],
        ];
        for ($i=0, $iCount=count($conditions); $i < $iCount; $i++) {
            if (in_array($value, $conditions[$i]['checks'])) {
                return $conditions[$i]['return'];
            }
        }

        if (strlen($value) > 1 && Strings::startsWith($value, '"') && Strings::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('getAttribute')) {
    function getAttribute(array $data, $attribute = null, $default = null)
    {
        return \Pbc\Bandolier\Type\Arrays::getAttribute($data, $attribute, $default);
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
