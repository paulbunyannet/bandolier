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

    public static function formatForTitle($string)
    {

        if (!is_string($string) || strlen($string) === 0) {
            return false;
        }
        $string = str_replace('_', ' ', $string);
        return Strings::titleCase($string);
    }

    /**
     * @param       $string
     * @param array $delimiters
     * @param array $exceptions
     *
     * @return bool|mixed|string
     */
    public static function titleCase(
        $string,
        $delimiters = [" ", "-", ".", "'", "O'", "Mc"],
        $exceptions = ["and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"]
    ) {
        /*
         * Exceptions in lower case are words you don't want converted
         * Exceptions all in upper case are any words you don't want converted to title case
         *   but should be converted to upper case, e.g.:
         *   king henry viii or king henry Viii should be King Henry VIII
         */
        $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
        foreach ($delimiters as $dlnr => $delimiter) {
            $words = explode($delimiter, $string);
            $newwords = [];
            foreach ($words as $wordnr => $word) {
                if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtoupper($word, "UTF-8");
                } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                    // check exceptions list for any words that should be in upper case
                    $word = mb_strtolower($word, "UTF-8");
                } elseif (!in_array($word, $exceptions)) {
                    // convert to uppercase (non-utf8 only)
                    $word = ucfirst($word);
                }
                array_push($newwords, $word);
            }
            $string = join($delimiter, $newwords);
        }
        //foreach
        return $string;
    }

    /**
     * If string starts with
     * http://stackoverflow.com/a/834355/405758
     *
     * @param $haystack
     * @param $needle
     *
     * @return bool
     */
    public static function startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    /**
     * If string ends with
     * http://stackoverflow.com/a/834355/405758
     *
     * @param $haystack
     * @param $needle
     * @return bool
     * @throws \Exception
     */
    public static function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            throw new \Exception("Needle must be one or more characters");
        }

        return (substr($haystack, -$length) === $needle);
    }

    /**
     * @param string $haystack
     * @param mixed $needle
     * @param bool $caseSensitive
     * @return bool
     */
    public static function contains($haystack, $needle, $caseSensitive = true)
    {
        // if needle is an array then check is one of it's values is in the haystack
        if (is_array($needle)) {
            for ($i = 0, $iCount = count($needle); $i < $iCount; $i++) {
                if (self::contains($haystack, $needle[$i], $caseSensitive) === true) {
                    return true;
                }
            }
            return false;
        }

        if ($caseSensitive) {
            return strlen(strstr($haystack, $needle)) > 0;
        } else {
            return strlen(stristr($haystack, $needle)) > 0;
        }
    }
}
