<?php
/**
 * Class MemcacheLocalFallback
 *
 * manages calls to MiniCache, fallback if memcache is down or not responsive
 *
 * @package         Member Manager
 * @subpackage      library
 * @category        library
 * @author          Nate Nolting <naten@paulbunyan.net>, Paul Bunyan Net
 * @link            http://www.paulbunyan.net
 * @updated         10/16/2013
 */

namespace Cache;

use Stash\Driver\FileSystem;
use Stash\Pool;
use Stash\Utilities;

/**
 * Class MemcacheLocalFallback
 * @package Memcache
 */
class Local implements CacheInterface
{

    /** @var null */
    private static $instance = null;
    /** @var Pool */
    protected $pool;
    protected $cachePath;

    /**
     * @return string
     */
    public function getCachePath()
    {
        return $this->cachePath;
    }

    /**
     * @param string $cachePath
     */
    public function setCachePath($cachePath)
    {
        $this->cachePath = $cachePath;
    }
    /** @var FileSystem  */
    private $fallback;


    /**
     * @return Local|null
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new Local();
        }
        return self::$instance;
    }

    /**
     * MemcacheLocalFallback constructor.
     */
    public function __construct()
    {
        $cachePath = dirname(dirname(__DIR__)) . '/cache/';

        $this->setCachePath($cachePath);
        $this->fallback = new FileSystem(['path' => $this->getCachePath()]);
        $this->pool = new Pool($this->fallback);
    }

    /**
     * Get key from fallback
     * @param string $id
     *
     * @param bool $useKeyRaw
     * @return bool|mixed
     */
    public function get($id, $useKeyRaw = false)
    {
        return $this->exists($id) ? $this->pool->getItem($id)->get() : false;
    }

    /**
     * Check if key exists in fallback
     *
     * @param $id
     *
     * @param bool $useKeyRaw
     * @return array|bool|mixed
     */
    public function exists($id, $useKeyRaw = false)
    {

        return $this->pool->hasItem($id) ? true : false;
    }

    /**
     * Flush the cache
     * @param bool $useKeyRaw
     * @return int|mixed
     */
    public function flush($useKeyRaw = false)
    {
        return $this->clear();
    }

    /**
     * Set a key
     *
     * @param string $id
     * @param mixed $data
     * @param null $duration
     *$key, $data, $duration = NULL, $useKeyRaw = false
     * @param bool $useKeyRaw
     * @return mixed
     */
    public function set($id, $data, $duration = null, $useKeyRaw = false)
    {
        $item = $this->pool->getItem($id);
        $item->set($data);
        $item->expiresAfter($duration);
        return $this->pool->save($item);
    }

    /**
     * Update a key
     *
     * @param $id
     * @param $data
     * @param $interval
     *
     * @param bool $useKeyRaw
     * @return mixed
     */
    public function update($id, $data, $interval, $useKeyRaw = false)
    {
        $item = $this->pool->getItem($id);
        $item->lock();
        $item->expiresAfter($interval);
        $this->pool->save($item->set($data));
        return $this->pool->save($item);
    }


    /**
     * @param $id
     * @param bool $useKeyRaw
     * @return bool
     */
    public function delete($id, $useKeyRaw = false)
    {
        $deleteItem = $this->pool->deleteItem($id);
        return $deleteItem;
    }

    /**
     * Flush cache
     *
     * @param array $list
     *
     * @return int|mixed
     */
    public function deleteAll($list = array())
    {
        return $this->clear();
    }

    /**
     * @param null|string $startDir path to start scan in
     * @return array
     */
    protected function scanCachePath($startDir=null)
    {
        /** @var string $cachePath path to scan */
        $cachePath = rtrim($this->getCachePath() . ltrim($startDir, '/'), '/');
        /** @var array $scan scan directory to loop over */
        $scan = @scandir($cachePath);
        if (!$scan) {
            return [];
        }
        return $scan;
    }

    /**
     * List all keys
     *
     * @param mixed $startDir
     * @return array
     */
    public function listAll($startDir = null)
    {
        $output = [];
        /** @var string $root path to scan */
        $root = rtrim($this->getCachePath() . ltrim($startDir, '/'), '/');
        /** @var array $scan scan directory to loop over */
        $scan = @scandir($root);
        if (!$scan) {
            return [];
        }
        for ($i = 0, $iCount = count($scan); $i < $iCount; $i++) {
            // if string is a directory run the check recursively again
            if (is_dir($root . DIRECTORY_SEPARATOR . $scan[$i]) && $scan[$i] !== '..' && $scan[$i] !== '.') {
                $output = array_merge($output, $this->listAll($startDir . '/' . $scan[$i]));
            } elseif(is_file($root . DIRECTORY_SEPARATOR . $scan[$i])) {
                include $root . DIRECTORY_SEPARATOR . $scan[$i];
                //var_dump($loaded, $expiration, $data);
                /** @var int $expiration */
                if (time() < $expiration) {
                    /** @var array $data */
                    //var_dump($data['return']);
                    $output[str_replace('/', '#', $root . DIRECTORY_SEPARATOR . $scan[$i])] = $data['return'];
                    //var_dump($output);
                }
            }
        }
        return $output;
    }

    private function clear()
    {
        $cleared = array_map(function($item){
            $path = $this->getCachePath() . $item;
            if ( $item === '.' || $item === '..' || $item === ".gitignore" || !file_exists($this->getCachePath() . $item)) {
                return ['path' => $path, 'cleared' => false];
            }
            return ['path' => $path, 'cleared' => Utilities::deleteRecursive($this->getCachePath() . $item)];
        }, $this->scanCachePath());
        return $cleared;
    }
}