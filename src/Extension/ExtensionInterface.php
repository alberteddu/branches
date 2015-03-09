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

/**
 * Interface ExtensionInterface
 *
 * @package Branches\Resolution
 */
interface ExtensionInterface
{
    /**
     * @param Branches $branches
     */
    public function setBranches(Branches $branches);

    public function extend();
}
