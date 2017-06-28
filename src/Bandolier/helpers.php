<?php
use Pbc\Bandolier\Type\Strings;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     * Borrowed from Illuminate/Foundation
     *
     * @param  string $key
     * @param  mixed $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        // get the environment variable
        $value = getenv($key);

        // if value is false just return the value
        if ($value === false) {
            return value($default);
        }

        // check the value against true, false, and null values
        $conditions = [
            ['return' => true, 'checks' => ['true', '(true)', '"true"']],
            ['return' => false, 'checks' => ['false', '(false)', '"false"']],
            ['return' => null, 'checks' => ['null', '(null)', '"null"']],
            ['return' => '', 'checks' => ['empty', '(empty)', '"empty"']],
        ];
        for ($i = 0, $iCount = count($conditions); $i < $iCount; $i++) {
            if (in_array($value, $conditions[$i]['checks'])) {
                return $conditions[$i]['return'];
            }
        }

        // strip the outer quotes from the value
        $value = Strings::stripOuterQuotes($value);

        return $value;
    }
}

if (!function_exists('getAttribute')) {
    /**
     * Get an attribute from an array.
     * @param array $data
     * @param null $attribute
     * @param null $default
     * @return mixed|null
     */
    function getAttribute(array $data, $attribute = null, $default = null)
    {
        return \Pbc\Bandolier\Type\Arrays::getAttribute($data, $attribute, $default);
    }
}


if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param  mixed $value
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('httpProtocol')) {
    function httpProtocol()
    {
        return Pbc\Bandolier\Type\Paths::httpProtocol();
    }
}
