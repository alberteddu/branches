<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url\Vote;

use Branches\Vote\VoterInterface;

/**
 * Interface UrlVoterInterface
 *
 * @package Branches\Url\Vote
 */
interface UrlSegmentVoterInterface extends VoterInterface
{
    /**
     * @param string $urlSegment
     */
    public function setUrlSegment($urlSegment);

    /**
     * @param string $pathSegment
     */
    public function setPathSegment($pathSegment);

    /**
     * @param string $segment
     *
     * @return string
     */
    public function transformSegment($segment);
}
