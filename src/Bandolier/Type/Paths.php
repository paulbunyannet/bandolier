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

use Pbc\Bandolier\Exception\Type\Paths\FileGetContentsException;

/**
 * Class Paths
 * @package Pbc\Bandolier\Type
 */
class Paths
{
    protected $domainNameWeb = 'web';
    /**
     * Path to check for whether inside
     * a docker container or not.
     */
    const CURL_CHECK_FILE = '/.dockerenv';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $curlCheckFile = "";

    /**
     * Paths constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Get domain name from string
     * http://stackoverflow.com/a/15498686/405758
     * @param string $url String holding a url
     * @return string|bool
     */
    public static function domainFromString($url)
    {
        $domain = parse_url($url, PHP_URL_HOST);
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }

    /**
     * Check to see what curl path should be used. If running in
     * localhost or currently run inside a container use web,
     * otherwise use the current SERVER_NAME
     *
     * @param string $toPath    Path to start from
     * @param Paths  $paths     Instance of Path (or mock)
     * @param string $dockerEnv Path to environment file that should exist if we're in a docker container
     *
     * @return string
     */
    public static function curlPath($toPath, $paths = null, $dockerEnv = "")
    {
        if (!$paths) {
            $paths = new Paths();
        }

        if (!$dockerEnv) {
            $dockerEnv = self::CURL_CHECK_FILE;
        }
        $serverName = self::serverName();

        if ($paths->domainNameIsWeb($serverName)
            || ($paths->domainNameIsLocalHost($serverName) && $paths->checkForEnvironmentFile($dockerEnv))
        ) {
            $serverName = $paths->getDomainNameWeb();
        }

        return self::httpProtocol() . '://' . $serverName . DIRECTORY_SEPARATOR . ltrim($toPath, DIRECTORY_SEPARATOR);
    }

    /**
     * Check environment for SERVER_NAME and fallback to the server global
     * @return string
     */
    public static function serverName()
    {
        return env('SERVER_NAME', (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : 'web'));
    }


    /**
     * @param string $file
     * @return bool
     * @codeCoverageIgnore
     */
    protected function checkForEnvironmentFile($file = self::CURL_CHECK_FILE)
    {
        return $file && file_exists($file);
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
     * @return string
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

    /**
     * Get content from a path
     * @param array $params parameters
     * @return string
     * @throws \Exception
     */
    public static function fileGetContents(array $params = [])
    {
        /** @var string $toPath Path to get request from */
        /** @var array $clientParams parameters passed into client */
        /** @var \GuzzleHttp\Client $client */
        /** @var string $request_type request type */
        /** @var array $requestParams parameters to pass into request */
        /** @var string $request type of request */
        $parameters = new Collection();
        $parameters->addItems((array)Arrays::defaultAttributes([
            "toPath" => self::httpProtocol() . '://' . self::serverName() . '/',
            "clientParams" => [],
            "client" => "\\GuzzleHttp\\Client",
            "request" => "GET",
            "requestParams" => [],
        ], $params));

        $parameters->addItem(parse_url($parameters->getItem('toPath'), PHP_URL_SCHEME) . "://" . parse_url($parameters->getItem('toPath'), PHP_URL_HOST), 'base_uri');
        $parameters->setItem(array_merge($parameters->getItem('clientParams'), array('base_uri' => $parameters->getItem('base_uri'))), 'clientParams');
        if (is_string($parameters->getItem('client'))) {
            $client = $parameters->getItem('client');
            $parameters->setItem(new $client($parameters->getItem('clientParams')), 'client');
        }

        $path = substr($parameters->getItem('toPath'), strlen($parameters->getItem('base_uri')), strlen($parameters->getItem('toPath')));
        if (method_exists($parameters->getItem('client'), 'request')) {
            // For GuzzleHttp 6
            return $parameters->getItem('client')
                ->request($parameters->getItem('request'), $path, $parameters->getItem('requestParams'))
                ->getBody()
                ->getContents();
        } elseif (method_exists($parameters->getItem('client'), 'createRequest')) {
            // for GuzzleHttp 5.3
            $request = $parameters->getItem('client')
                ->createRequest($parameters->getItem('request'), $path, $parameters->getItem('requestParams'));
            return $parameters->getItem('client')->send($request)->getBody();
        } else {
          throw new FileGetContentsException('The client must be an instance of \\GuzzleHttp\\Client');
        }
    }

    /**
     * @param string $serverName
     * @return bool
     */
    public function domainNameIsLocalHost($serverName)
    {
        $local = strpos($serverName, '.local');
        return is_int($local) && !is_bool($local);
    }

    /**
     * @param $serverName
     * @return bool
     */
    private function domainNameIsWeb($serverName)
    {
        return $serverName === $this->getDomainNameWeb();
    }

    /**
     * @return string
     */
    public function getCurlCheckFile()
    {
        return $this->curlCheckFile;
    }

    /**
     * @param string $curlCheckFile
     *
     * @return void
     */
    public function setCurlCheckFile($curlCheckFile = null)
    {
        if (!$curlCheckFile) {
            $curlCheckFile = self::CURL_CHECK_FILE;
        }
        $this->curlCheckFile = $curlCheckFile;
    }

    /**
     * Traverse path to make file
     * @param string $filePath path to file to check if it exists
     * @param string|null $content content of file to be written
     * @return bool|int
     */
    public static function filePutContents($filePath, $content = null)
    {
        // https://stackoverflow.com/a/282140/405758
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0775, true);
        }
        return file_put_contents($filePath, $content);
    }

    /**
     * Delete a non empty folder
     * https://stackoverflow.com/a/1653776/405758
     * http://us3.php.net/rmdir
     *
     * @param $dir
     * @param string $dir
     *
     * @return bool
     */
    public static function rmDir($dir)
    {
        if (!file_exists($dir)) {
            return true;
        }
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            if (!Paths::rmDir($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }
        return rmdir($dir);
    }

    /**
     * @return string
     */
    public function getDomainNameWeb()
    {
        return $this->domainNameWeb;
    }

    /**
     * @param string $domainNameWeb
     *
     * @return void
     */
    public function setDomainNameWeb($domainNameWeb)
    {
        $this->domainNameWeb = $domainNameWeb;
    }
}
