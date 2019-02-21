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

    protected static $types = array('json','serialized','base64');

    protected static $base64BadCharacterThreshold = 35;

    /**
     * Find a key inside a string that may or may not be encoded
     * @param string $strange String to decode
     * @param string $thing   Key to find
     * @param bool   $strict  Whether to be strict with encoding. If true and the
     * encoding type can not be  found then an exception will be thrown
     *
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \BadMethodCallException
     */
    public static function getThingThatIsEncoded($strange, $thing, $strict = false)
    {
        $encodeType = self::getEncodeType($strange, $strict);
        // If no encoded type gets returned and we're running in "strict" then return an exception...
        if (!$encodeType && $strict) {
            throw new \InvalidArgumentException('No encoded type could be found for the string.');
        }

        $unpackMethod = 'unpack'.ucfirst((string)$encodeType);
        //  In case the first check passes but the the unpack method does not exist...
        if (!method_exists(Encoded::class, $unpackMethod) && $strict) {
            throw new \BadMethodCallException('The unpack method '.__CLASS__.'::'.$unpackMethod.' does not exist.');
        }
        switch ($encodeType) {
            case ('json'):
            case ('serialized'):
                $decode = Encoded::{$unpackMethod}($strange);
                if (array_key_exists($thing, $decode)) {
                    return $decode[$thing];
                }
                break;
            case('base64'):
                $decode = Encoded::{$unpackMethod}($strange);
                return self::getThingThatIsEncoded($decode, $thing);
            default:
                break;
        }

        return $strange;
    }

    /**
     * @param string $string String to check the encoding of
     * @param bool   $strict
     * @return bool|string
     */
    public static function getEncodeType($string, $strict = false)
    {
        $return = false;
        array_walk(self::$types, function($type) use (&$return, $string){
          static $found = false;
          if ($found) {
            return;
          }
          $unpackMethod = 'is'.ucfirst($type);
          if (in_array($unpackMethod, get_class_methods(Encoded::class)) && self::$unpackMethod($string)) {
              $found = true;
              $return = $type;
          }
        });
        if (!$return && !$strict) {
            return 'unknown';
        }
        return $return;

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
     *
     * @param $string
     * @param string $string
     *
     * @return bool
     */
    public static function isSerialized($string)
    {
        $data = @unserialize($string);
        return $data !== false;
    }

    /**
     * Check and see if a string is base64 encoded
     * https://stackoverflow.com/a/30231906/405758
     * @param $string
     * @return bool
     */
    public static function isBase64($string)
    {
        if(!is_string($string)) return false;

        // Check if there is no invalid character in string
        if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

        // Decode the string in strict mode and send the response
        if (!base64_decode($string, true)) return false;

        // Encode and compare it to original one
        if (base64_encode(base64_decode($string, true)) !== $string) return false;

        // http://www.albertmartin.de/blog/code.php/19/base64-detection
        // check for bad character when decoding the base64 string
        $check = str_split(base64_decode($string, true));
        $x = 0;
        array_walk($check, function($char) use (&$x){
            if (ord($char) > 126) $x++;
        });
        //var_dump("Count: ". $x . " " . ($x/count($check)*100) . "%" . PHP_EOL);
        if ($x/count($check)*100 > self::$base64BadCharacterThreshold) return false;

        return true;

    }

    /**
     * @param $string
     * @param bool $associativeArray
     * @param string $string
     *
     * @return mixed
     */
    public static function unpackJson($string, $associativeArray = true)
    {
        return json_decode($string, $associativeArray);
    }

    /**
     * @param $data
     * @return string
     */
    public static function packJson($data)
    {
        return json_encode($data);
    }

    /**
     * @param $string
     * @param string $string
     *
     * @return mixed
     */
    public static function unpackSerialized($string)
    {
        return unserialize($string);
    }

    /**
     * @param $data
     * @return string
     */
    public static function packSerialized($data)
    {
        return serialize($data);
    }

    /**
     * Unpack a base64 encoded string
     *
     * @param $string
     * @param string $string
     *
     * @return mixed
     */
    public static function unpackBase64($string)
    {
      return base64_decode($string, true);
    }

    /**
     * Pack a base64 encoded string
     *
     * @param $string
     * @param string $string
     *
     * @return string
     */
    public static function packBase64($string)
    {
      return base64_encode($string);
    }

}
