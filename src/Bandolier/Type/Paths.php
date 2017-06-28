<?php
/**
 * Paths
 *
 * Created 6/28/17 10:22 AM
 * Path helpers
 *
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Bandolier\Type
 */

namespace Pbc\Bandolier\Type;


/**
 * Class Paths
 * @package Pbc\Bandolier\Type
 */
class Paths
{

    /**
     * httpProtocol
     * Return what the http protocol is for the current page.
     * @return string
     */
    public static function httpProtocol()
    {
        return self::httpsOn() || self::serverPort() === 443 ? 'https' : 'http';
    }

    /**
     * Check environment for HTTPS and fallback to the server global
     * @return null
     */
    public static function https()
    {
        return env(
            'HTTPS',
            (isset($_SERVER['HTTPS']) ? $_SERVER['HTTPS'] : 'off')
        );
    }

    /**
     * Check environment for SERVER_PORT and fallback to the server global
     * @return int
     * @SuppressWarnings(PHPMD.LongVariable)
     */
    public static function serverPort()
    {
        return (int)env(
            'SERVER_PORT',
            (isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80)
        );
    }

    /**
     * @return bool
     */
    public static function httpsOn()
    {
        return strtolower(self::https()) === 'on';
    }
}
