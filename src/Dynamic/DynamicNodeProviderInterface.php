<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Dynamic;

use Branches\Url\Url;

/**
 * Interface DynamicNodeProviderInterface
 *
 * @package Branches\Provider
 */
interface DynamicNodeProviderInterface
{
    /**
     * @param Url $url
     *
     * @return array
     */
    public function provide(Url $url);
}
