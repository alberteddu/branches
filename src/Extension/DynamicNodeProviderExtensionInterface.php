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
 * Interface DynamicNodeProviderExtensionInterface
 *
 * @package Branches\Extension
 */
interface DynamicNodeProviderExtensionInterface
{
    /**
     * @param SplPriorityQueue $queue
     */
    public function getDynamicPostProviders(SplPriorityQueue $queue);

    /**
     * @param SplPriorityQueue $queue
     */
    public function getDynamicFileProviders(SplPriorityQueue $queue);
}
