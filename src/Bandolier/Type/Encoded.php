<?php
/**
 * Encoded
 *
 * Created 10/3/16 3:13 PM
 * Encoded Class, handling encode strings
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

/**
 * Class Encoded
 * @package Pbc\Bandolier\Type
 */
class Encoded
{

    /**
     * Find a key inside a string that may or may not be encoded
     * @param $strange
     * @param $thing
     * @return mixed
     */
    public static function getThingThatIsEncoded($strange, $thing)
    {
        $encodeType = self::getEncodeType($strange);
        switch ($encodeType) {
            case ('json'):
            case ('serialized'):
                $unpackMethod = 'unpack'.ucfirst($encodeType);
                $decode = self::$unpackMethod($strange);
                if (array_key_exists($thing, $decode)) {
                    return $decode[$thing];
                }
                break;
        }

        return $strange;
    }

    /**
     * @param $string
     * @return bool|string
     */
    public static function getEncodeType($string)
    {
        if (self::isJson($string)) {
            return 'json';
        }
        if (self::isSerialized($string)) {
            return 'serialized';
        }

        return false;

    }

    /**
     * Check if string is json
     * @param $string
     * @return bool
     */
    public static function isJson($string)
    {
        if (!is_string($string) || (is_string($string)
                && substr($string, 0, 1) !== '{'
                && substr($string, 0, 1) !== '[')
        ) {
            return false;
        }
        @json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Check if string is serialized
     * @param $string
     * @return bool
     */
    public static function isSerialized($string)
    {
        $data = @unserialize($string);
        return $data !== false;
    }

    /**
     * @param $string
     * @param bool $associativeArray
     * @return mixed
     */
    public static function unpackJson($string, $associativeArray = true)
    {
        return json_decode($string, $associativeArray);
    }

    /**
     * @param $string
     * @return mixed
     */
    public static function unpackSerialized($string)
    {
        return unserialize($string);
    }
}
