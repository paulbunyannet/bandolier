<?php

namespace Cache;

/**
 * Interface TemplateElementInterface
 *
 * PHP version 5
 *
 * @category   Class
 * @package    ACN
 * @subpackage Views
 * @author     Nate Nolting <naten@paulbunyan.net>
 * @copyright  1997-2014 Paul Bunyan Communications
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link       http://www.paulbunyan.net
 */
interface CacheInterface {

    /**
     * Get a key from Memcache
     * @param $id
     *
     * @return mixed
     */
    public function get($id, $useKeyRaw = false);

    /**
     * Check if memcache key exists
     * @param $id
     *
     * @return mixed
     */
    public  function exists($id, $useKeyRaw = false);

    /**
     * Flush keys
     *
     * @return mixed
     */
    public function flush($useKeyRaw = false);


    /**
     * Set a key
     *
     * @param $id
     * @param $data
     * @param $interval
     *
     * @return mixed
     */
    public function set($id, $data, $duration = NULL, $useKeyRaw = false);

    /**
     * Update a key
     *
     * @param $id
     * @param $data
     * @param $interval
     *
     * @return mixed
     */
    public function update($id, $data, $interval, $useKeyRaw = false);


    /**
     * Delete cache
     *
     * @param $id
     * @return bool|void
     */
    public function delete($id, $useKeyRaw = false);


    /** Delete all keys */
    public function deleteAll($list = array());

    /** list all keys */
    public function listAll($startDir=NULL);

}

