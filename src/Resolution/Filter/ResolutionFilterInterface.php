<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Resolution\Filter;

use Branches\Resolution\ResolutionInterface;

/**
 * Interface ResolutionFilterInterface
 *
 * @package Branches\Resolution\Filter
 */
interface ResolutionFilterInterface
{
    /**
     * @param string              $url
     * @param ResolutionInterface $resolution
     * @param ResolutionInterface $originalResolution
     *
     * @return ResolutionInterface
     */
    public function filter($url, ResolutionInterface $resolution, ResolutionInterface $originalResolution);
}
