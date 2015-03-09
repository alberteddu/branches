<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use Branches\Provider\PostListProviderInterface;

/**
 * Class PostList
 *
 * @package Branches\Node
 */
class PostList extends NodeList implements PostListInterface
{
    /**
     * @return PostListProviderInterface
     */
    protected function getProvider()
    {
        return $this->branches->getPostListProvider();
    }
}
