<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use Branches\Branches;
use Branches\Url\Url;

/**
 * Class AbstractPost
 *
 * @package Branches\Node
 */
class AbstractPost extends Post
{
    /** @var string */
    protected $segment;

    /**
     * @param Branches $branches
     * @param Url      $url
     * @param string   $segment
     */
    public function __construct(Branches $branches, Url $url, $segment)
    {
        $this->segment = $segment;

        parent::__construct($branches, $url->append($segment), '');
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * @return PostListInterface
     */
    public function getChildren()
    {
        return $this->branches->getNodeManager()->getNodesAt($this->getPath(), $this->getUrl(), NodeType::POST, true);
    }

    /**
     * @return PostListInterface
     */
    public function getAttachments()
    {
        return $this->branches->getNodeManager()->getNodesAt($this->getPath(), $this->getUrl(), NodeType::FILE, true);
    }
}
