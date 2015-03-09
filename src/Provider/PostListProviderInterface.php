<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Provider;

use Branches\Node\PostInterface;
use Branches\Node\PostListInterface;

/**
 * Interface FileListProviderInterface
 *
 * @package Branches\Provider
 */
interface PostListProviderInterface extends NodeListProviderInterface
{
    /**
     * @param PostInterface[] $elements
     *
     * @return PostListInterface
     */
    public function provide(array $elements);
}
