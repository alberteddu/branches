<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

/**
 * Interface FileInterface
 *
 * @package Branches\Node
 */
interface FileInterface extends NodeInterface
{
    /**
     * @return PostInterface
     */
    public function getPost();
}
