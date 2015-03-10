<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url;

use Branches\Branches;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\UrlSegmentVoterExtensionInterface;
use Branches\Manager\Manager;
use Branches\Url\Vote\UrlSegmentVoterInterface;
use Branches\Vote\VoteResult;
use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;
use SplPriorityQueue;

/**
 * Class UrlManager
 *
 * @package Branches\Url
 */
class UrlManager extends Manager
{
    /**
     * @param Url $url
     *
     * @return false|Location
     */
    public function urlMatches(Url $url)
    {
        $currentPath = $this->branches->getPath();
        $urlSegments = array();

        foreach ($url->getSegments() as $urlSegment) {
            $found           = false;
            $realPathSegment = $urlSegment;
            $realUrlSegment  = $urlSegment;

            /** @var DirectoryIterator $nodePath */
            foreach (new RecursiveDirectoryIterator($currentPath, FilesystemIterator::SKIP_DOTS) as $nodePath) {
                if ($found) {
                    break;
                }

                $pathSegment = $nodePath->getFilename();

                if (($realUrlSegment = $this->segmentMatches($urlSegment, $pathSegment))) {
                    $found           = true;
                    $realPathSegment = $pathSegment;
                }
            }

            if (!$found) {
                return false;
            }

            $currentPath .= '/' . $realPathSegment;
            $urlSegments[] = $realUrlSegment;
        }

        $realUrl = new Url(implode('/', $urlSegments));

        return new Location($realUrl, $currentPath);
    }

    /**
     * @param $urlSegment
     * @param $pathSegment
     *
     * @return bool
     */
    protected function segmentMatches($urlSegment, $pathSegment)
    {
        $result         = false;
        $realUrlSegment = $urlSegment;

        foreach ($this->getUrlSegmentVoters() as $urlSegmentVoter) {
            $urlSegmentVoter->setUrlSegment($urlSegmentVoter->transformSegment($urlSegment));
            $urlSegmentVoter->setPathSegment($pathSegment);

            if ($urlSegmentVoter->vote() === VoteResult::NO) {
                $result = false;
            }

            if ($urlSegmentVoter->vote() === VoteResult::YES) {
                $result = true;
                $realUrlSegment = $urlSegmentVoter->transformSegment($urlSegment);
            }
        }

        return $result ? $realUrlSegment : false;
    }

    /**
     * @return string
     */
    public function buildPath()
    {
        $segments = func_get_args();

        array_unshift($segments, $this->branches->getPath());

        return call_user_func_array('\joinPaths', $segments);
    }

    /**
     * @return Vote\UrlSegmentVoterInterface[]
     */
    public function getUrlSegmentVoters()
    {
        return $this->branches->getExtensionManager()->collect(function(ExtensionInterface $extension, SplPriorityQueue $queue) {
            if($extension instanceof UrlSegmentVoterExtensionInterface) {
                $extension->getUrlSegmentVoters($queue);
            }
        });
    }
}
