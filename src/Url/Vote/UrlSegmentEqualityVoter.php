<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url\Vote;

use Branches\Url\Url;
use Branches\Vote\VoteResult;
use Branches\Vote\VoterInterface;

/**
 * Class UrlSegmentEqualityVoter
 *
 * @package Branches\Url\Vote
 */
class UrlSegmentEqualityVoter extends UrlSegmentVoter implements UrlSegmentVoterInterface
{
    /**
     * @return bool
     */
    public function vote()
    {
        return (string) $this->urlSegment == $this->pathSegment ? VoteResult::YES : VoteResult::ABSTAIN;
    }
}
