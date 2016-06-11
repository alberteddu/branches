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
 * Class NotFoundResolution.
 */
class NotFoundResolution implements ResolutionInterface
{
    /**
     * @return int
     */
    public function getResolutionType()
    {
        return ResolutionType::NOT_FOUND;
    }

    /**
     * @return NodeInterface
     */
    public function getNode()
    {
        return;
    }
}
