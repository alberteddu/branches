<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Manager;

use Branches\Branches;

/**
 * Class Manager
 *
 * @package Branches\Manager
 */
abstract class Manager
{
    /** @var Branches */
    protected $branches;

    /**
     * @param Branches $branches
     */
    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }
}
