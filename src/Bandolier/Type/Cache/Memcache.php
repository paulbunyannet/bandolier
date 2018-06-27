<?php

namespace Cache;

/**
 * Class MemcacheClass
 *
 * Manage calls to memcache server for caching
 * Local fallback class included in case memcache connection can not be found
 *
 * @package         Dragon_Boat
 * @subpackage      library
 * @category        library
 * @author          Bryan Boardwine  <tonic2good@gmail.com>
 * @author          Nate Nolting <naten@paulbunyan.net>, Paul Bunyan Net
 * @link            http://www.paulbunyan.net
 * @updated         10/16/2013
 */

Class Memcache implements CacheInterface
{
    /** @var string $prefix Prefix for memcache keys */
    private static $prefix;

    /** @var string $cur_key current key */
    private static $curKey;

    /** @var string $cur_cache current cache */
    private static $curCache;

    /** @var bool $useLocal whether to use local fallback if memcache is un available */
    private static $useLocal;

    /** @var Local localFallback instance of local fallback */
    private static $localFallback;

    /** @var string  local fallback class if memcache is not available */
    private static $localFallbackClass;

    /** @var string location of local fallback class */
    private static $localFallbackClassLocation;

    /** @var string $server what server memcache is located on */
    private static $host;

    /** @var string memcache server port */
    private static $port;

    /** @var \Memcache  */
    protected $memcache;

    /**
     * Get instance of MemcacheClass
     *
     * @return Memcache
     */
    public static function getInstance()
    {
        static $instance = null;
        if ($instance == null)
            $instance = new Memcache();
        return $instance;
    }

    /**
     * Construct
     */
    public function __construct()
    {
        /** get config */
        require_once __DIR__ . '/config.php';

        self::$useLocal = CACHE_USE_LOCAL;
        self::$prefix = CACHE_PREFIX;
        self::$localFallbackClass = CACHE_LOCAL_FALLBACK_CLASS;
        self::$localFallbackClassLocation = CACHE_LOCAL_FALLBACK_CLASS_LOCATION;
        self::$host = CACHE_HOST;
        self::$port = CACHE_PORT;


        if (!function_exists('memcache_connect') || !class_exists('\Memcache') || CACHE_USE_LOCAL === true) {
            self::$useLocal = true;
            //die('Memcache is not currently installed...');
        } else {
            try {
                $this->memcache = New \Memcache;
                $this->memcache->addServer(self::$host, self::$port);
                $stats = @$this->memcache->getExtendedStats();
                $available = (bool)(is_array($stats) && array_key_exists(self::$host . ':' . self::$port, $stats) ? $stats[self::$host . ':' . self::$port] : false);
                $connect = false;
                if($available) {
                    $connect = @$this->memcache->connect(self::$host, self::$port);
                }

                if ($available && $connect) {
                    // memcache connected successfully, use memcache instead of local
                    self::$useLocal = false;

                } else {
                    // could not connect, fall back to local
                    self::$useLocal = true;
                    //die('Could not connect to the Memcache host');
                }
            } catch (\Exception $ex) {
                error_log('Fail: ' . $ex->getMessage() . PHP_EOL);
            }

        }

        $fb = "\\Cache\\" . self::$localFallbackClass;
        self::$localFallback = $fb::getInstance();

    }

    public static function getPrefix()
    {
        return self::$prefix;
    }

    /**
     * @return boolean
     */
    public static function isUseLocal()
    {
        return self::$useLocal;
    }

    /**
     * @param boolean $useLocal
     */
    public static function setUseLocal($useLocal)
    {
        self::$useLocal = $useLocal;
    }

    /**
     * @return Local
     */
    public static function getLocalFallback()
    {
        return self::$localFallback;
    }

    /**
     * Load local fall back if set true in constructor
     * @param $method
     * @param $arguments
     * @throws \Exception
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if (self::$useLocal) {
            if (!method_exists(self::$localFallback, $method)) {
                throw new \Exception('Undefined method ' . get_class(self::$localFallback) . '::' . $method . '() called');
            }
            return call_user_func_array(array(self::$localFallback, $method), $arguments);
        }

        throw new \Exception('Undefined method ' . get_class($this) . '::' . $method . '() called');
    }


    /**
     * Check if a cache exists
     * @param $id
     * @param bool $useKeyRaw
     * @return bool
     */
    public function exists($id, $useKeyRaw = true)
    {

        $cacheKey = $this->keyHash($id);
        if (self::$useLocal) {
            return self::$localFallback->exists($cacheKey, $useKeyRaw);
        }

        if ($this->memcache->get(self::$prefix . $cacheKey)) {
            self::$curCache = $this->memcache->get(self::$prefix . $cacheKey);
            self::$curKey = self::$prefix . $cacheKey;
            return true;
        } else {
            return false;
        }

    }

    /**
     * Delete cache
     * @param $id
     * @param bool $useKeyRaw
     * @return bool|void
     */
    public function delete($id, $useKeyRaw = true)
    {
        $cacheKey = $this->keyHash($id);
        // if using local
        if (self::$useLocal) {
            return self::$localFallback->delete($cacheKey, $useKeyRaw);
        }

        if ($this->memcache->get(self::$prefix . $cacheKey)) {
            $delete = $this->memcache->delete(self::$prefix . $cacheKey);
            self::$localFallback->delete($cacheKey, $useKeyRaw);
            return $delete;

        } else {
            return false;
        }
    }

    /**
     * Delete all cache
     *
     * @param array $list list of keys to remove
     *
     * @return $this
     */
    public function flush($list = array())
    {
        if (self::$useLocal) {
            return self::$localFallback->flush(true);
        }

        $flush = $this->deleteAll($list);
        self::$localFallback->flush(true);
        return $flush;

    }

    /**
     * Delete all stored cache items
     *
     * @param array $list list of keys to remove
     *
     * @return $this
     */
    public function deleteAll($list = array())
    {
        $deleted = 0;
        if ($list && count($list) > 0) {
            foreach(array_values($list) as $key) {
                $delete = $this->delete($key);
                if ($delete) {
                    $deleted++;
                    unset($delete);
                }


            }

        } else {
            $all = $this->listAll();
            if ($all) {
                foreach ($all as $key) {
                    $delete = $this->delete($key);
                    if($delete) {
                        $deleted++;
                        unset($delete);
                    }
                }
            }
        }

        return $deleted;
    }


    /**
     * Update a cache
     * @param $id
     * @param $data
     * @param $interval
     * @param bool $useKeyRaw
     * @return bool|void
     */
    public function update($id, $data, $interval, $useKeyRaw = true)
    {
        $interval = (isset($interval)) ? $interval : 60 * 60 * 0.15;
        $cacheKey = $this->keyHash($id);

        if (self::$useLocal) {
            return self::$localFallback->update($cacheKey, $data, $interval, $useKeyRaw);
        }

        if (self::$prefix . self::$curKey) {
            if (!empty(self::$curCache)) {
                $replace = $this->memcache->replace(self::$curKey, $data, MEMCACHE_COMPRESSED, $interval);
                if ($replace) {
                    self::$localFallback->set(self::$curKey, $data, $interval);
                }
                return $replace;
            }
        } elseif ($this->memcache->get(self::$prefix . $cacheKey)) {
            $replace = $this->memcache->replace(self::$prefix . $cacheKey, $data, MEMCACHE_COMPRESSED, $interval);
            if ($replace) {
                self::$localFallback->set($cacheKey, $data, $interval);
            }
            return $replace;
        }

        return false;
    }

    /**
     * Get a cache
     * @param $id
     * @param bool $useKeyRaw
     * @return array|string
     */
    public function get($id, $useKeyRaw = true)
    {
        $cacheKey = $this->keyHash($id);
        if (self::$useLocal) {
            return self::$localFallback->get($cacheKey, $useKeyRaw);
        }

        return $this->memcache->get(self::$prefix . $cacheKey);

    }

    /**
     * Set a cache
     * @param $id
     * @param $data
     * @param null|int $duration
     * @param bool $useKeyRaw
     * @return bool
     */
    public function set($id, $data, $duration = NULL, $useKeyRaw = true)
    {
        $interval = (isset($interval)) ? $interval : 60 * 60 * 0.15;
        $cacheKey = $this->keyHash($id);

        if (self::$useLocal) {
            $set = self::$localFallback->set($cacheKey, $data, $interval, $useKeyRaw);
        } else {
            $set = $this->memcache->set(self::$prefix . $cacheKey, $data, MEMCACHE_COMPRESSED, $interval);
            if ($set) {
                self::$localFallback->set($cacheKey, $data, $interval, $useKeyRaw);
            }
        }

        return $set;
    }

    /**
     * List all keys
     * @param null $startDir
     * @return array
     */
    public function listAll($startDir=NULL)
    {
        if (self::$useLocal) {
            $listAllFallback = self::$localFallback->listAll($startDir=NULL);
            return $listAllFallback ? array_filter(array_keys($listAllFallback)) : array();
        }

        $list = array();
        $allSlabs = $this->memcache->getExtendedStats('slabs');
        $items = $this->memcache->getExtendedStats('items');
        foreach($allSlabs as $server => $slabs) {
            foreach($slabs AS $slabId => $slabMeta) {
                $cdump = $this->memcache->getExtendedStats('cachedump',(int)$slabId);
                foreach($cdump AS $keys => $arrVal) {
                    if (!is_array($arrVal)) continue;
                    foreach($arrVal AS $k => $v) {

                        if (substr($k, 0, strlen(self::$prefix)) == self::$prefix && $this->exists(substr($k, strlen(self::$prefix), strlen($k)))) {
                            array_push($list, substr($k, strlen(self::$prefix), strlen($k)));
                        }
                    }
                }
            }
        }

        return $list;
    }

    /**
     * Hash cache key
     *
     * @param $id
     * @return string
     */
    protected function keyHash($id)
    {
        return md5($id);
    }


}