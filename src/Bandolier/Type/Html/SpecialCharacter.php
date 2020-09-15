<?php

namespace Pbc\Bandolier\Type\Html;

use Pbc\Bandolier\Type\BaseType;

class SpecialCharacter extends BaseType
{
    /**
     * Superscript special characters
     * @see https://en.wikipedia.org/wiki/Registered_trademark_symbol#Related_symbols
     * @param $string string to modify
     * @param array $characters List of characters to find and apply superscript
     * @return string
     */
    public static function superscriptSpecialCharacters(string $string, array $characters = []) : string
    {

        $defaults = [
            'registered' => ['®', '&reg;', '&#x00AE;', '&#174;'],
            'trademark'  => ['™', '&trade;', '&#8482;'],
            'copyright'  => ['©', '&#169;', '&copy;'],
            'service'    => ['℠', '&#8480;'],
            'phonogram'  => ['℗', '&#8471;'],
            'hechsher'   => ['Ⓤ', '&#9418;']
        ];
        $characters = array_merge($defaults, $characters);
        $specials = [''];
        array_walk_recursive($characters, function ($v) use (&$specials) {
            if (strlen($v) > 0) {
                $specials[] = $v;
            }
        });
        $specials = array_values(array_filter($specials));
        // wrap all the special characters above with superscript tags
        for ($i = 0, $iCount = count($specials); $i < $iCount; $i++) {
            if (strpos($string, $specials[$i]) !== false) {
                $string = str_replace($specials[$i], '<sup>' . $specials[$i] . '</sup>', $string);
            }
        }

        return $string;
    }
}
