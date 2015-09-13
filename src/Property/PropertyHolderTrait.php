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
     * @param bool  $deep
     */
    public function mergeProperties(array $properties, $deep = true)
    {
        if ($deep) {
            $this->setProperties(self::deepMergeProperties(array($this->getProperties(), $properties)));
        } else {
            $this->setProperties(array_merge($this->getProperties(), $properties));
        }
    }

    /**
     * @param array[] $arrays
     *
     * @return array
     *
     * @see https://api.drupal.org/api/drupal/includes%21bootstrap.inc/function/drupal_array_merge_deep_array/7
     */
    public static function deepMergeProperties($arrays)
    {
        $result = array();

        foreach ($arrays as $array) {
            foreach ($array as $key => $value) {
                // Renumber integer keys as array_merge_recursive() does. Note that PHP
                // automatically converts array keys that are integer strings (e.g., '1')
                // to integers.
                if (is_integer($key)) {
                    $result[] = $value;
                } // Recurse when both values are arrays.
                elseif (isset($result [$key]) && is_array($result [$key]) && is_array($value)) {
                    $result[$key] = self::deepMergeProperties(array($result [$key], $value));
                } // Otherwise, use the latter value, overriding any previous value.
                else {
                    $result[$key] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if ($this->isPropertySet($property)) {
            return $this->getProperty($property);
        }

        return null;
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    public function __isset($property)
    {
        return $this->isPropertySet($property);
    }
}
