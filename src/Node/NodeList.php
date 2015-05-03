<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use ArrayIterator;
use ArrayObject;
use Branches\Branches;
use Branches\Provider\NodeListProviderInterface;
use IteratorAggregate;

/**
 * Class NodeList
 *
 * @package Branches\Node
 */
abstract class NodeList extends ArrayObject implements NodeListInterface
{
    /** @var Branches */
    protected $branches;

    /** @var array */
    protected $elements = array();

    public function __construct(Branches $branches, array $elements)
    {
        $this->branches = $branches;
        $this->elements = $elements;

        parent::__construct($this->elements);
    }

    /**
     * @param callable $callback
     *
     * @return NodeListInterface
     */
    public function map(callable $callback)
    {
        return $this->getProvider()->provide(array_map($callback, $this->elements));
    }

    /**
     * @param callable $callback
     *
     * @return NodeListInterface
     */
    public function filter(callable $callback)
    {
        return $this->getProvider()->provide(array_filter($this->elements, $callback));
    }

    /**
     * @param NodeInterface $node
     *
     * @return NodeListInterface
     */
    public function except(NodeInterface $node)
    {
        return $this->filter(function (NodeInterface $eachNode) use ($node) {
            $eachNode->is($node);
        });
    }

    /**
     * @return NodeListProviderInterface
     */
    abstract protected function getProvider();
}
