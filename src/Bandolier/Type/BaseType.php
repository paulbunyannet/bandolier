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

class BaseType
{

    /**
     * Arrays constructor.
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $this->initialize($params);
        return $this;
    }

    /**
     * @param $params
     */
    protected function initialize($params)
    {
        foreach ($params as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }
}
