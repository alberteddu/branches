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
     * @return string
     */
    public function getAnchor()
    {
        return str_replace('/', '--', $this->url);
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        return $this->getUrl()->isRoot();
    }

    /**
     * @return PostInterface|NodeInterface|null
     */
    public function getParent()
    {
        if ($this->isRoot()) {
            return null;
        }

        return $this->branches->get((string)$this->getUrl()->sliceSegments(0, -1));
    }

    /**
     * @return PostListInterface
     */
    public function getParents()
    {
        $posts = [];
        $current = $this;

        while (($parent = $current->getParent())) {
            array_unshift($posts, $parent);

            $current = $parent;
        }

        return $this->branches->getPostListProvider()->provide($posts);
    }

    /**
     * @return PostListInterface
     */
    public function getSiblings()
    {
        if ($this->isRoot()) {
            return $this->branches->getPostListProvider()->provide([]);
        }

        return $this->getParent()->getChildren()->except($this);
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
