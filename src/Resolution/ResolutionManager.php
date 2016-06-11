<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Resolution;

use Branches\Component\ComponentHolder;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\ResolutionExtensionInterface;
use Branches\Manager\Manager;
use Branches\Node\NodeInterface;
use Branches\Resolution\Filter\ResolutionFilterInterface;
use Branches\Url\Url;

/**
 * Class ResolutionManager.
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
     * @param Url                 $url
     * @param ResolutionInterface $resolution
     *
     * @return ResolutionInterface
     */
    public function filterResolution(Url $url, ResolutionInterface $resolution)
    {
        $originalResolution = $resolution;

        /** @var ResolutionFilterInterface $resolutionFilter */
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
        return $this->branches->getExtensionManager()->collect(function (ExtensionInterface $extension, ComponentHolder $queue) {
            if ($extension instanceof ResolutionExtensionInterface) {
                $extension->getResolutionFilters($queue);
            }
        });
    }
}
