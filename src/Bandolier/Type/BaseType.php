<?php
/**
 * BaseType
 *
 * Base helper type
 * @author Nate Nolting <naten@paulbunyan.net>
 * @package Pbc\Bandolier\Type
 * @subpackage Subpackage
 */

namespace Pbc\Bandolier\Type;

use Pbc\Bandolier\Exception\Collection\KeyInvalidException;

class BaseType
{

    /**
     * BaseType constructor.
     * @param array $params
     * @throws KeyInvalidException
     */
    public function __construct(array $params = [])
    {
        $this->initialize($params);
    }

    /**
     * @param array $params
     * @return $this
     * @throws KeyInvalidException
     */
    protected function initialize(array $params = [])
    {
        if (!empty($params)) {
            foreach ($params as $field => $value) {
                $this->setData($field, $value);
            }
        }
        return $this;
    }

    /**
     * @param string $field
     * @param mixed  $value
     *
     * @return $this
     *
     * @throws KeyInvalidException
     */
    protected function setData(string $field, $value)
    {
        if (property_exists($this, $field)) {
            $this->{$field} = $value;
        } else {
            throw new KeyInvalidException("Property \"{$field}\" does not exist on \"". get_class($this) ."\".");
        }

        return $this;
    }
}
