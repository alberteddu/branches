<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension;

use Branches\Component\BranchesAwareInterface;
use Branches\Component\BranchesAwareTrait;

/**
 * Class BranchesAwareExtension
 *
 * @package Branches\Extension
 */
abstract class BranchesAwareExtension implements BranchesAwareInterface
{
    use BranchesAwareTrait;
}
