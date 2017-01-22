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
 * Interface PostInterface.
 */
interface PostInterface extends NodeInterface
{
    /**
     * @return string
     */
    public function getAnchor();

    /**
     * @return bool
     */
    public function isRoot();

    /**
     * @return PostInterface|null
     */
    public function getParent();

    /**
     * @return PostListInterface|PostInterface[]
     */
    public function getParents();

    /**
     * @return PostListInterface|PostInterface[]
     */
    public function getSiblings();

    /**
     * @param bool $skipDynamic
     *
     * @return PostListInterface|PostInterface[]
     */
    public function getChildren($skipDynamic = false);

    /**
     * @param bool $skipDynamic
     *
     * @return FileListInterface|FileInterface[]
     */
    public function getAttachments($skipDynamic = false);
}
