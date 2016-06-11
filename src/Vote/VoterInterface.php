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
 * Interface VoterInterface.
 */
interface VoterInterface
{
    /**
     * @return bool
     */
    public function vote();
}
