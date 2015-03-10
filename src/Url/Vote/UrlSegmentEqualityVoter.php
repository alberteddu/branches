<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url\Vote;

use Branches\Branches;
use Branches\Component\BranchesAwareInterface;
use Branches\Component\BranchesAwareTrait;
use Branches\Component\ComponentHolder;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\UrlExtensionInterface;
use Branches\Vote\VoteResult;

/**
 * Class UrlSegmentEqualityVoter
 *
 * @package Branches\Url\Vote
 */
class UrlSegmentEqualityVoter extends UrlSegmentVoter implements ExtensionInterface, UrlExtensionInterface, UrlSegmentVoterInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'branches.url-segment-equality-voter';
    }

    /**
     * @return bool
     */
    public function vote()
    {
        return (string) $this->urlSegment == $this->pathSegment ? VoteResult::YES : VoteResult::NO;
    }

    /**
     * @param ComponentHolder $queue
     */
    public function getUrlSegmentVoters(ComponentHolder $queue)
    {
        $queue->insert($this, 0);
    }
}
