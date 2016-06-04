<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Resolution;

use Branches\Node\NodeInterface;

/**
 * Class NodeResolution
 *
 * @package Branches\Resolution
 */
abstract class NodeResolution implements ResolutionInterface
{
    /**
     * @var NodeInterface
     */
    private $node;

    /**
     * @return integer
     */
    abstract public function getResolutionType();

    /**
     * @param NodeInterface $node
     */
    public function __construct(NodeInterface $node = null)
    {
        $this->node = $node;
    }

    /**
     * @param NodeInterface $node
     */
    public function setNode($node)
    {
        $this->node = $node;
    }

    /**
     * @return NodeInterface
     */
    public function getNode()
    {
        return $this->node;
    }
}
