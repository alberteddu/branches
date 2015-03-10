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
use Branches\Property\PropertyHolderTrait;
use Branches\Url\Url;

/**
 * Class Node
 *
 * @package Branches\Node
 */
abstract class Node implements NodeInterface
{
    use PropertyHolderTrait;

    /** @var Branches */
    protected $branches;

    /** @var Url */
    protected $url;

    /** @var string */
    protected $path;

    public function __construct(Branches $branches, Url $url, $path)
    {
        $this->branches = $branches;
        $this->url      = $url;
        $this->path     = $path;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param NodeInterface $node
     *
     * @return bool
     */
    public function is(NodeInterface $node)
    {
        return $this == $node;
    }
}
