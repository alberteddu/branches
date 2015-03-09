<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Provider;

use Branches\Branches;
use Branches\Node\PostList;
use Branches\Node\PostListInterface;

/**
 * Class PostListProvider
 *
 * @package Branches\Provider
 */
class PostListProvider implements PostListProviderInterface
{
    /** @var Branches */
    protected $branches;

    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @param array $elements
     *
     * @return PostListInterface
     */
    public function provide(array $elements)
    {
        return new PostList($this->branches, $elements);
    }
}
