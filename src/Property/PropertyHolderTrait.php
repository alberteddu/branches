<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Property;

/**
 * Class PropertyHolderTrait
 *
 * @package Branches\Property
 */
trait PropertyHolderTrait
{
    /** @var array */
    protected $properties = array();

    /**
     * @param $name
     * @param $value
     */
    public function setProperty($name, $value)
    {
        $this->properties[$name] = $value;
    }

    /**
     * @param      $name
     *
     * @param null $default
     *
     * @return mixed
     */
    public function getProperty($name, $default = null)
    {
        if (!isset($this->properties[$name])) {
            return $default;
        }

        return $this->properties[$name];
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function isPropertySet($name)
    {
        return isset($this->properties[$name]);
    }
}
