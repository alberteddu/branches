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
 * Class PostResolution
 *
 * @package Branches\Resolution
 */
class PostResolution extends NodeResolution implements ResolutionInterface
{
    public function getResolutionType()
    {
        return ResolutionType::POST;
    }
}
