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
 * Interface PropertyHolderInterface.
 */
interface PropertyHolderInterface
{
    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setProperty($name, $value);

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getProperty($name, $default = null);

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isPropertySet($name);

    /**
     * @param array $properties
     */
    public function setProperties(array $properties);

    /**
     * @param array $properties
     * @param bool  $deep
     */
    public function mergeProperties(array $properties, $deep = true);

    /**
     * @return array
     */
    public function getProperties();
    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property);

    /**
     * @param string $property
     *
     * @return bool
     */
    public function __isset($property);
}
