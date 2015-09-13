<?php
namespace Pbc\Bandolier\Type;

class Strings
{

    /**
     * Strip wild slashes in strings, with up to triple slash stripping (anymore than that should be handled elsewhere)
     * Example:
     * use Pbc\Bandolier\Type\String;
     * $string = String::stripSlashes('A string with a bunch of \\\ slashes in it');
     *
     * @param $string
     * @return mixed
     */
    public static function stripSlashes($string)
    {
        $string = stripslashes($string);
        $string = str_replace("\\\\", "\\", $string);
        $string = str_replace("\\\"", "\"", $string);
        $string = str_replace("\\'", "'", $string);
        $string = str_replace("\\\'", "'", $string);
        $string = str_replace('\\\"', '"', $string);
        return $string;
    }
}