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
use Branches\Url\Url;

/**
 * Interface ResolutionFilterInterface.
 */
interface ResolutionFilterInterface
{
    /**
     * @param Url                 $url
     * @param ResolutionInterface $resolution
     * @param ResolutionInterface $originalResolution
     *
     * @return ResolutionInterface
     */
    public function filter(Url $url, ResolutionInterface $resolution, ResolutionInterface $originalResolution);
}
