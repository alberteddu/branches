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
     * @return PostInterface|null
     */
    public function getParent();

    /**
     * @return PostListInterface
     */
    public function getSiblings();

    /**
     * @param bool $skipDynamic
     *
     * @return PostListInterface
     */
    public function getChildren($skipDynamic = false);

    /**
     * @param bool $skipDynamic
     *
     * @return FileListInterface
     */
    public function getAttachments($skipDynamic = false);
}
