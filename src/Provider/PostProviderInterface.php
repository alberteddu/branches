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
use Branches\Node\PostInterface;
use Branches\Url\Url;

/**
 * Interface PostProviderInterface
 *
 * @package Branches\Provider
 */
interface PostProviderInterface
{
    /**
     * @param Url    $url
     * @param string $realpath
     *
     * @return PostInterface
     */
    public function provide(Url $url, $realpath);
}
