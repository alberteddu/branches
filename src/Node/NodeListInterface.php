<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Node;

/**
 * Interface NodeListInterface.
 */
interface NodeListInterface
{
    /**
     * @return int
     */
    public function count();

    /**
     * @param callable $callback
     *
     * @return NodeListInterface
     */
    public function map(callable $callback);

    /**
     * @param callable $callback
     *
     * @return NodeListInterface
     */
    public function filter(callable $callback);

    /**
     * @param NodeInterface $node
     *
     * @return NodeListInterface
     */
    public function except(NodeInterface $node);

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return NodeListInterface
     */
    public function where($key, $value);
}
