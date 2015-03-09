<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Resolution;

use Branches\Branches;
use Branches\Node\NodeInterface;
use Branches\Resolution\Filter\ResolutionFilterInterface;

/**
 * Class ResolutionManager
 *
 * @package Branches\Resolution
 */
class ResolutionManager
{
    /** @var Branches */
    protected $branches;

    /** @var ResolutionFilterInterface[] */
    protected $resolutionFilters = array();

    /**
     * @param Branches $branches
     */
    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @param ResolutionInterface $resolution
     *
     * @return NodeInterface
     */
    public function resolve(ResolutionInterface $resolution)
    {
        return $resolution->getNode();
    }

    /**
     * @param string              $url
     * @param ResolutionInterface $resolution
     *
     * @return ResolutionInterface
     */
    public function filterResolution($url, ResolutionInterface $resolution)
    {
        $originalResolution = $resolution;

        usort($this->resolutionFilters, function (ResolutionFilterInterface $a, ResolutionFilterInterface $b) {
            return $a->getPriority() - $b->getPriority();
        });

        foreach ($this->resolutionFilters as $resolutionFilter) {
            $resolution = $resolutionFilter->filter($url, $resolution, $originalResolution);
        }

        return $resolution;
    }

    /**
     * @param ResolutionFilterInterface $resolutionFilter
     */
    public function addResolutionFilter(ResolutionFilterInterface $resolutionFilter)
    {
        $resolutionFilter->setBranches($this->branches);

        $this->resolutionFilters[] = $resolutionFilter;
    }
}
