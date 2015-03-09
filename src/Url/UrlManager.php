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

    public function urlMatches(Url $url, $path)
    {
        $currentPath = $path;

        foreach ($url->getSegments() as $urlSegment) {
            $found           = false;
            $realPathSegment = $urlSegment;

            foreach (new RecursiveDirectoryIterator($currentPath, FilesystemIterator::SKIP_DOTS) as $nodePath) {
                if ($found) {
                    break;
                }

                $pathSegment = $nodePath->getFilename();

                if ($this->segmentMatches($urlSegment, $pathSegment)) {
                    $found           = true;
                    $realPathSegment = $pathSegment;
                }
            }

            if (!$found) {
                return false;
            }

            $currentPath .= '/' . $realPathSegment;
        }

        return $currentPath;
    }

    protected function segmentMatches($urlSegment, $pathSegment)
    {
        foreach ($this->urlSegmentVoters as $urlSegmentVoter) {
            $urlSegmentVoter->setUrlSegment($urlSegment);
            $urlSegmentVoter->setPathSegment($pathSegment);

            if ($urlSegmentVoter->vote() === VoteResult::NO) {
                return false;
            }
        }

        return true;
    }

    public function addUrlSegmentVoter(UrlSegmentVoterInterface $urlSegmentVoter)
    {
        $this->urlSegmentVoters[] = $urlSegmentVoter;
    }
}
