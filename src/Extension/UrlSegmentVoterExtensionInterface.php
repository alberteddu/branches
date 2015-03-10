<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension;

use Branches\Branches;
use SplPriorityQueue;

/**
 * Interface UrlSegmentVoterExtensionInterface
 *
 * @package Branches\Extension
 */
interface UrlSegmentVoterExtensionInterface
{
    /**
     * @param SplPriorityQueue $queue
     */
    public function getUrlSegmentVoters(SplPriorityQueue $queue);
}
