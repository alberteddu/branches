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
use Branches\Node\File;
use Branches\Url\Url;

/**
 * Class FileProvider
 *
 * @package Branches\Provider
 */
class FileProvider implements FileProviderInterface
{
    /**
     * @var Branches
     */
    protected $branches;

    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

    public function provide(Url $url, $realpath)
    {
        return new File($this->branches, $url, $realpath);
    }
}
