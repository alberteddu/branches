<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension;

use Branches\Component\BranchesAwareInterface;
use Branches\Component\ComponentHolder;
use Branches\Manager\Manager;

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
        if ($extension instanceof BranchesAwareInterface) {
            $extension->setBranches($this->branches);
        }

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
     * @param callable $callback
     *
     * @return ComponentHolder
     */
    public function collect(callable $callback)
    {
        $queue = new ComponentHolder();
        $queue->setBranches($this->branches);

        foreach ($this->getExtensions() as $extension) {
            call_user_func($callback, $extension, $queue);
        }

        return $queue;
    }

    /**
     * @return ExtensionInterface[]
     */
    public function getExtensions()
    {
        return $this->extensions;
    }
}
