<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension;

use Branches\Manager\Manager;
use SplPriorityQueue;

/**
 * Class ExtensionManager
 *
 * @package Branches\Extension
 */
class ExtensionManager extends Manager
{
    /** @var ExtensionInterface[] */
    protected $extensions = array();

    /**
     * @param string             $name
     * @param ExtensionInterface $extension
     */
    public function register($name, ExtensionInterface $extension)
    {
        $this->extensions[$name] = $extension;
    }

    /**
     * @param $name
     */
    public function unregister($name)
    {
        unset($this->extensions[$name]);
    }

    /**
     * @return ExtensionInterface[]
     */
    public function getExtensions()
    {
        return $this->extensions;
    }

    /**
     * @param callable $callback
     *
     * @return SplPriorityQueue
     */
    public function collect(callable $callback)
    {
        $queue = new SplPriorityQueue();

        foreach($this->getExtensions() as $extension) {
            call_user_func($callback, $extension, $queue);
        }

        return $queue;
    }
}
