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
use Branches\Extension\ExtensionInterface;
use Branches\Extension\UrlSegmentVoterExtensionInterface;
use Branches\Url\Url;
use Branches\Vote\VoteResult;
use Branches\Vote\VoterInterface;
use SplPriorityQueue;

/**
 * Class UrlSegmentEqualityVoter
 *
 * @package Branches\Url\Vote
 */
class UrlSegmentEqualityVoter extends UrlSegmentVoter implements ExtensionInterface, UrlSegmentVoterExtensionInterface, UrlSegmentVoterInterface
{
    /** @var Branches */
    protected $branches;

    /**
     * @return bool
     */
    public function vote()
    {
        return (string) $this->urlSegment == $this->pathSegment ? VoteResult::YES : VoteResult::NO;
    }

    /**
     * @param Branches $branches
     */
    public function setBranches(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @param SplPriorityQueue $queue
     */
    public function getUrlSegmentVoters(SplPriorityQueue $queue)
    {
        $queue->insert($this, 0);
    }
}
