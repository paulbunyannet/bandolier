<?php
/**
 * Arrays
 *
 * Created 10/24/16 9:53 PM
 * Arrays
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;

class Arrays
{
    /**
     * From default attribute list, overwrite if key is found
     * @param array $defaults
     * @param array $attributes
     * @return array|bool
     */
    public static function defaultAttributes(array $defaults = [], array $attributes = [])
    {
        foreach ($attributes as $name => $value) {
            if (array_key_exists($name, $defaults)) {
                $defaults[$name] = $value;
            }
        }
        return ($defaults) ? $defaults : false;
    }
}
