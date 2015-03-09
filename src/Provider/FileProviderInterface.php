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
use Branches\Node\FileInterface;
use Branches\Url\Url;

/**
 * Interface FileProviderInterface
 *
 * @package Branches\Provider
 */
interface FileProviderInterface
{
    /**
     * @param Url   $url
     * @param string   $realpath
     *
     * @return FileInterface
     */
    public function provide(Url $url, $realpath);
}
