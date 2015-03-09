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
use Branches\Url\Vote\UrlSegmentVoterInterface;
use Branches\Vote\VoteResult;
use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;

/**
 * Class UrlManager
 *
 * @package Branches\Url
 */
class UrlManager
{
    /** @var Branches */
    protected $branches;

    /** @var UrlSegmentVoterInterface[] */
    protected $urlSegmentVoters = array();

    /**
     * @param Branches $branches
     */
    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

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

        foreach ($this->urlSegmentVoters as $urlSegmentVoter) {
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
     * @param UrlSegmentVoterInterface $urlSegmentVoter
     */
    public function addUrlSegmentVoter(UrlSegmentVoterInterface $urlSegmentVoter)
    {
        $this->urlSegmentVoters[] = $urlSegmentVoter;
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
}
