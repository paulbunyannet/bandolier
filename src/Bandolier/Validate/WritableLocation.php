<?php
/**
 * Class WritableLocation
 *
 * PHP version >= 5.6
 *
 * @category Validate
 * @package  paulbunyannet/bandolier
 * @author   Nate Nolting <naten@paulbunyan.net>
 * @license  MIT https://opensource.org/licenses/MIT
 * @version  GIT: <git_id>
 * @link     https://github.com/paulbunyannet/bandolier
 */
namespace Pbc\Bandolier\Validate;

use Pbc\Bandolier\Exception\Writable\LocationDoesExist;
use Pbc\Bandolier\Exception\Writable\LocationIsADirectory;
use Pbc\Bandolier\Exception\Writable\LocationIsWritable;
use Pbc\Bandolier\Setup;
use Pbc\Bandolier\Type\Arrays;

/**
 * Class WritableLocation
 *
 * @category Validate
 * @package  paulbunyannet/bandolier
 * @author   Nate Nolting <naten@paulbunyan.net>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://github.com/paulbunyannet/bandolier
 */
class WritableLocation extends Setup
{
    const WRITABLE_DOES_NOT_EXIST_ERROR   = 10;
    const WRITABLE_IS_NOT_A_DIR_ERROR     = 20;
    const WRITABLE_IS_NOT_WRITABLE_ERROR  = 30;

    /**
     * Path to check if writable
     *
     * @var string $path
     */
    protected $path;

    /**
     * List of valid keys in the $config
     * array passed to the constructor
     *
     * @var array
     */
    protected $properties = ['path'];

    /**
     * Return the path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * WritableLocation constructor.
     *
     * @param array $config Config array containing the path key
     *
     * @throws LocationDoesExist|LocationIsADirectory|LocationIsWritable
     * @return WritableLocation
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->path = Arrays::getAttribute($config, 'path');

        $this->doesExist();
        $this->isADirectory();
        $this->isWritable();
        return $this;
    }

    /**
     * Check if path is writable
     *
     * @return bool
     * @throws LocationIsWritable
     */
    protected function isWritable()
    {
        if (!is_writable($this->path)) {
            throw new LocationIsWritable(
                $this->getPath() . ' is not writable!',
                self::WRITABLE_IS_NOT_WRITABLE_ERROR
            );
        }
        return true;
    }

    /**
     * Check if path exists
     *
     * @throws LocationDoesExist
     * @return bool
     */
    protected function doesExist()
    {
        if (!file_exists($this->path)) {
            throw new LocationDoesExist(
                $this->getPath() .' does not exist!',
                self::WRITABLE_DOES_NOT_EXIST_ERROR
            );
        }
        return true;
    }

    /**
     * Check if path is a directory
     *
     * @return bool
     * @throws LocationIsADirectory
     */
    protected function isADirectory()
    {
        if (file_exists($this->path) && !is_dir($this->path)) {
            throw new  LocationIsADirectory(
                $this->getPath() .' already exists but is not a directory!',
                self::WRITABLE_IS_NOT_A_DIR_ERROR
            );
        }
        return true;
    }
}
