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
 * Interface UrlExtensionInterface.
 */
interface UrlExtensionInterface extends ExtensionInterface
{
    /**
     * @param ComponentHolder $queue
     */
    public function getUrlSegmentVoters(ComponentHolder $queue);
}
