<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Dynamic;

use Branches\Node\PostInterface;
use Branches\Url\Url;

/**
 * Interface DynamicFileProviderInterface
 *
 * @package Branches\Dynamic
 */
interface DynamicFileProviderInterface extends DynamicNodeProviderInterface
{
    /**
     * @param Url           $url
     * @param PostInterface $post
     *
     * @return DynamicFile[]
     */
    public function provide(Url $url, PostInterface $post);
}
