<?php
namespace Pbc\Bandolier;

use Pbc\Bandolier\Exception\UnknownPropertyException;

/**
 * Class Setup
 * @category Exception
 * @package  paulbunyannet/bandolier
 * @author   Nate Nolting <naten@paulbunyan.net>
 * @license  MIT https://opensource.org/licenses/MIT
 * @version  GIT: <git_id>
 * @link     https://github.com/paulbunyannet/bandolier
 */
abstract class Setup
{
    /** @var array $properties settable properties */
    protected $properties = [];

    /**
     * Setup constructor.
     * @param array $config
     */
    public function __construct($config = []) {
        $this->init($config);
    }

    /**
     * @param array $config
     * @return $this
     */
    protected function init(array $config = [])
    {
        // walk over all the config keys and check to see if they can be set
        array_walk($config, function($value, $key) {
            if (property_exists($this, $key) && in_array($key, $this->properties)) {
                $this->{$key} = $value;
            } else {
                throw new UnknownPropertyException('Unknown property "'. $key .'" on '. get_class($this) .'.');
            }
        });
        // set defaults is there are any
        array_walk($this->properties, function($property){

            if(!$this->{$property} && method_exists($this, 'default'.ucfirst($property))) {
                $this->{$property} = $this->{'default'.ucfirst($property)}();
            }
        });
        return $this;
    }
}