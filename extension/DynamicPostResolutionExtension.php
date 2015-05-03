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

class DynamicPostResolutionExtension extends Extension implements ResolutionExtensionInterface {

    /**
     * @return string
     */
    public function getName()
    {
        return 'branches-dynamic-post-resolution';
    }

    /**
     * @param ComponentHolder $queue
     */
    public function getResolutionFilters(ComponentHolder $queue)
    {
        $queue->insert(new DynamicPostResolutionFilter());
    }
}
