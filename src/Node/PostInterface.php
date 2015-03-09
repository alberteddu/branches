<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

/**
 * Interface PostInterface
 *
 * @package Branches\Node
 */
interface PostInterface extends NodeInterface
{
    /**
     * @return PostInterface|null
     */
    public function getParent();

    /**
     * @return PostListInterface
     */
    public function getSiblings();

    /**
     * @return PostListInterface
     */
    public function getChildren();

    /**
     * @return FileListInterface
     */
    public function getAttachments();
}
