<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Resolution;

/**
 * Class PostResolution.
 */
class PostResolution extends NodeResolution implements ResolutionInterface
{
    /**
     * @return int
     */
    public function getResolutionType()
    {
        return ResolutionType::POST;
    }
}
