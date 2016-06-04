<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Component;

use Branches\Branches;

/**
 * Class BranchesAwareTrait
 *
 * @package Branches\Component
 */
trait BranchesAwareTrait
{
    /**
     * @var Branches
     */
    protected $branches;

    /**
     * @param Branches $branches
     */
    public function setBranches(Branches $branches)
    {
        $this->branches = $branches;
    }
}
