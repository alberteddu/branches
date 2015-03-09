<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url\Vote;

use Branches\Vote\VoteResult;

/**
 * Class UrlVoter
 *
 * @package Branches\Url\Vote
 */
abstract class UrlSegmentVoter implements UrlSegmentVoterInterface
{
    /** @var string */
    protected $urlSegment;

    /** @var string */
    protected $pathSegment;

    /**
     * @param string $urlSegment
     */
    public function setUrlSegment($urlSegment)
    {
        $this->urlSegment = $urlSegment;
    }

    /**
     * @param string $pathSegment
     */
    public function setPathSegment($pathSegment)
    {
        $this->pathSegment = $pathSegment;
    }
}
