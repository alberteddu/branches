<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Provider;

use Branches\Node\NodeInterface;
use Branches\Node\NodeListInterface;

/**
 * Interface NodeListProviderInterface
 *
 * @package Branches\Provider
 */
interface NodeListProviderInterface
{
    /**
     * @param NodeInterface[] $elements
     *
     * @return NodeListInterface
     */
    public function provide(array $elements);
}
