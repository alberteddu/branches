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
 * Interface NodeInterface.
 */
interface NodeInterface
{
    /**
     * @return string
     */
    public function getUrl();

    /**
     * @return string
     */
    public function getPath();

    /**
     * @param NodeInterface $node
     *
     * @return bool
     */
    public function is(NodeInterface $node);
}
