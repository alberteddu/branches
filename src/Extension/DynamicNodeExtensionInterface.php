<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension;

use Branches\Component\ComponentHolder;

/**
 * Interface DynamicNodeExtensionInterface
 *
 * @package Branches\Extension
 */
interface DynamicNodeExtensionInterface extends ExtensionInterface
{
    /**
     * @param ComponentHolder $queue
     */
    public function getDynamicPostProviders(ComponentHolder $queue);

    /**
     * @param ComponentHolder $queue
     */
    public function getDynamicFileProviders(ComponentHolder $queue);
}
