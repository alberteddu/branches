<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Component;

use SplPriorityQueue;

/**
 * Class ComponentHolder
 *
 * @package Branches\Component
 */
class ComponentHolder extends SplPriorityQueue implements BranchesAwareInterface
{
    use BranchesAwareTrait;

    /**
     * @param mixed $value
     * @param int   $priority
     */
    public function insert($value, $priority = 0)
    {
        if ($value instanceof BranchesAwareInterface) {
            $value->setBranches($this->branches);
        }

        parent::insert($value, $priority);
    }
}
