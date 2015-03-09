<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Resolution;

/**
 * Interface ResolutionInterface
 *
 * @package Branches\Resolution
 */
abstract class ResolutionType
{
    const NOT_FOUND = 0;

    const POST = 1;

    const FILE = 2;
}
