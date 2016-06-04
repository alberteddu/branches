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
use Branches\Node\Post;
use Branches\Url\Url;

/**
 * Class NodeProvider
 *
 * @package Branches\Provider
 */
class PostProvider implements PostProviderInterface
{
    /**
     * @var Branches
     */
    protected $branches;

    /**
     * @param Branches $branches
     */
    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @param Url    $url
     * @param string $realpath
     *
     * @return Post
     */
    public function provide(Url $url, $realpath)
    {
        return new Post($this->branches, $url, $realpath);
    }
}
