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
 * Class Post.
 */
class Post extends Node implements PostInterface
{
    /**
     * @return bool
     */
    public function isRoot()
    {
        return $this->getUrl()->isRoot();
    }

    /**
     * @return PostInterface|null
     */
    public function getParent()
    {
        if ($this->isRoot()) {
            return null;
        }

        return $this->branches->get((string) $this->getUrl()->sliceSegments(0, -1));
    }

    /**
     * @return PostListInterface
     */
    public function getSiblings()
    {
        return $this->getChildren()->except($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren($skipDynamic = false)
    {
        return $this->branches->getNodeManager()->getNodesAt($this, $this->getPath(), $this->getUrl(), NodeType::POST, false, $skipDynamic);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttachments($skipDynamic = false)
    {
        return $this->branches->getNodeManager()->getNodesAt($this, $this->getPath(), $this->getUrl(), NodeType::FILE, false, $skipDynamic);
    }
}
