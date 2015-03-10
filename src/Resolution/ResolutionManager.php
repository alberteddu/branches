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
use Branches\Component\ComponentHolder;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\ResolutionExtensionInterface;
use Branches\Manager\Manager;
use Branches\Node\NodeInterface;

/**
 * Class ResolutionManager
 *
 * @package Branches\Resolution
 */
class ResolutionManager extends Manager
{
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

        foreach ($this->getResolutionFilters() as $resolutionFilter) {
            $resolution = $resolutionFilter->filter($url, $resolution, $originalResolution);
        }

        return $resolution;
    }

    /**
     * @return ComponentHolder
     */
    public function getResolutionFilters()
    {
        return $this->branches->getExtensionManager()->collect(function(ExtensionInterface $extension, ComponentHolder $queue) {
            if($extension instanceof ResolutionExtensionInterface) {
                $extension->getResolutionFilters($queue);
            }
        });
    }
}
