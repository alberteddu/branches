<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Vote;

/**
 * Class VoteResult.
 */
abstract class VoteResult
{
    const YES = true;
    const NO = false;
    const ABSTAIN = -1;
}
