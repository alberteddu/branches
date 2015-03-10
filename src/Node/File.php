<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use Branches\Branches;
use Branches\Property\PropertyHolderTrait;

/**
 * Class File
 *
 * @package Branches\Node
 */
class File extends Node implements FileInterface
{
    /**
     * @return PostInterface
     */
    public function getPost()
    {
        return $this->branches->get((string) $this->getUrl()->sliceSegments(0, -1));
    }
}
