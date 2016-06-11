<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Provider;

use Branches\Node\FileInterface;
use Branches\Node\FileListInterface;

/**
 * Interface FileListProviderInterface.
 */
interface FileListProviderInterface extends NodeListProviderInterface
{
    /**
     * @param FileInterface[] $elements
     *
     * @return FileListInterface
     */
    public function provide(array $elements);
}
