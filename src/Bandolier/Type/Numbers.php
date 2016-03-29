<?php
/**
 * Numbers
 *
 * Created 3/29/16 4:48 PM
 * Methods for working with numbers or number like strings
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 */

namespace Pbc\Bandolier\Type;


class Numbers
{

    /**
     * Convert string to float
     * http://php.net/manual/en/function.floatval.php#114486
     *
     * $num = '1.999,369€';
     * var_dump(tofloat($num)); // float(1999.369)
     * $otherNum = '126,564,789.33 m²';
     * var_dump(tofloat($otherNum)); // float(126564789.33)
     *
     * @param $num
     * @return mixed
     */
    public static function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
        );
    }

}