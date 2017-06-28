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

use function PHPSTORM_META\type;


/**
 * Class Paths
 * @package Pbc\Bandolier\Type
 */
class Paths
{

    const CURL_CHECK_FILE = '/.dockerenv';

    public function __construct()
    {

        return $this;
    }

    /**
     * Check to see what curl path should be used. If running in
     * localhost or currently run inside a container use web,
     * otherwise use the current SERVER_NAME
     * @param $toPath
     * @param Paths $paths pass an instance of Path (or mock)
     * @return string
     */
    public static function curlPath($toPath, $paths)
    {
        $serverName = self::serverName();
        if (strpos($serverName, '.local') !== false
            || file_exists($paths->getCurlCheckForWebFileName())
        ) {
            $serverName = 'web';
        }
        return self::httpProtocol() . '://' . $serverName . DIRECTORY_SEPARATOR . ltrim($toPath, DIRECTORY_SEPARATOR);
    }

    /**
     * Check environment for SERVER_PORT and fallback to the server global
     * @return int
     */
    public static function serverName()
    {
        return env(
            'SERVER_NAME',
            (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'web')
        );
    }


    public function getCurlCheckForWebFileName($file = null)
    {
        return $file && file_exists($file) ? $file : self::CURL_CHECK_FILE;
    }

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
     * @return bool
     */
    public static function httpsOn()
    {
        return strtolower(self::https()) === 'on';
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

    /*
     * Get the curl check file name. this is used to check in we're in a container or not.
     */

    /**
     * Check environment for SERVER_PORT and fallback to the server global
     * @return int
     */
    public static function serverPort()
    {
        return (int)env(
            'SERVER_PORT',
            (isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80)
        );
    }
}
