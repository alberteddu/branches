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
use Branches\Node\FileList;
use Branches\Node\FileListInterface;

/**
 * Class FileListProvider
 *
 * @package Branches\Provider
 */
class FileListProvider implements FileListProviderInterface
{
    /**
     * @var Branches
     */
    protected $branches;

    public function __construct(Branches $branches)
    {
        $this->branches = $branches;
    }

    /**
     * @param array $elements
     *
     * @return FileListInterface
     */
    public function provide(array $elements)
    {
        return new FileList($this->branches, $elements);
    }
}
