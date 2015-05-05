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
     * @param $name
     * @param $default
     *
     * @return mixed
     */
    public function getProperty($name, $default = null)
    {
        if (!$this->isPropertySet($name)) {
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

    /**
     * @param array $properties
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param array $properties
     */
    public function mergeProperties(array $properties)
    {
        $this->setProperties(array_merge($this->getProperties(), $properties));
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
