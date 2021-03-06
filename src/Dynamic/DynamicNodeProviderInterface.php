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
 * Interface DynamicNodeProviderInterface.
 */
interface DynamicNodeProviderInterface
{
    /**
     * @param Url           $url
     * @param PostInterface $post
     *
     * @return array
     */
    public function provide(Url $url, PostInterface $post);
}
