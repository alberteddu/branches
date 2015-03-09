<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Resolution\Filter;

use Branches\Branches;
use Branches\Resolution\ResolutionInterface;

/**
 * Class ResolutionFilter
 *
 * @package Branches\Resolution\Filter
 */
abstract class ResolutionFilter implements ResolutionFilterInterface
{
    /** @var Branches */
    protected $branches;

    /**
     * @param Branches $branches
     */
    public function setBranches(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @return Branches
     */
    public function getBranches()
    {
        return $this->branches;
    }
}
