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
 * Interface ResolutionInterface
 *
 * @package Branches\Resolution
 */
interface ResolutionInterface
{
    /**
     * @return integer
     */
    public function getResolutionType();

    /**
     * @return NodeInterface
     */
    public function getNode();
}
