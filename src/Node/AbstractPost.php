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
 * Class AbstractPost.
 */
class AbstractPost extends Post
{
    /**
     * @var string
     */
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
     * {@inheritdoc}
     */
    public function getChildren($skipDynamic = false)
    {
        return $this->branches->getNodeManager()->getNodesAt($this, $this->getPath(), $this->getUrl(), NodeType::POST, true, $skipDynamic);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttachments($skipDynamic = false)
    {
        return $this->branches->getNodeManager()->getNodesAt($this, $this->getPath(), $this->getUrl(), NodeType::FILE, true, $skipDynamic);
    }
}
