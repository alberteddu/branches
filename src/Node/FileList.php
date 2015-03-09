<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use Branches\Provider\FileListProviderInterface;

/**
 * Interface FileInterface
 *
 * @package Branches\Node
 */
class FileList extends NodeList implements FileListInterface
{
    /**
     * @return FileListProviderInterface
     */
    protected function getProvider()
    {
        return $this->branches->getFileListProvider();
    }
}
