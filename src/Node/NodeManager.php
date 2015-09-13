<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use BadMethodCallException;
use Branches\Branches;
use Branches\Component\ComponentHolder;
use Branches\Dynamic\DynamicFileProviderInterface;
use Branches\Dynamic\DynamicPostProviderInterface;
use Branches\Extension\DynamicNodeExtensionInterface;
use Branches\Extension\ExtensionInterface;
use Branches\Manager\Manager;
use Branches\Resolution\FileResolution;
use Branches\Resolution\NotFoundResolution;
use Branches\Resolution\PostResolution;
use Branches\Url\Url;
use Branches\Url\UrlManager;
use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;

/**
 * Class PostManager
 *
 * @package Branches\Node
 */
class NodeManager extends Manager
{
    /**
     * @param PostInterface $parentPost
     * @param string        $path
     * @param string        $url
     * @param string        $nodeType
     * @param bool          $isAbstract
     * @param bool          $skipDynamic
     *
     * @return PostListInterface
     *
     * @throws BadMethodCallException if $nodeType is not valid (see NodeType::*).
     */
    public function getNodesAt(PostInterface $parentPost, $path, $url, $nodeType, $isAbstract = false, $skipDynamic = false)
    {
        if (!in_array($nodeType, array(NodeType::POST, NodeType::FILE))) {
            throw new BadMethodCallException('Invalid node type');
        }

        $nodes = array();

        if (!$isAbstract) {
            /** @var DirectoryIterator $nodePath */
            foreach (new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS) as $nodePath) {
                try {
                    $node = $this->get(UrlManager::join($url, $nodePath->getBasename()));

                    if (NodeType::POST === $nodeType and $node instanceof PostInterface) {
                        $nodes[] = $node;
                    } elseif (NodeType::FILE === $nodeType and $node instanceof FileInterface) {
                        $nodes[] = $node;
                    }
                } catch(NodeNotFoundException $e) {
                    // We ignore non existing files.
                }
            }
        }

        $urlObject = new Url($url);

        if (NodeType::POST === $nodeType) {
            $listProvider     = $this->branches->getPostListProvider();
            $dynamicProviders = $this->getDynamicPostProviders();

            /** @var DynamicPostProviderInterface $dynamicProvider */
            foreach ($dynamicProviders as $dynamicProvider) {
                foreach ($dynamicProvider->provide($urlObject, $parentPost) as $dynamicPost) {
                    $newAbstractPost = new AbstractPost($this->branches, $urlObject, $dynamicPost->getSegment());
                    $newAbstractPost->setProperties($dynamicPost->getProperties());
                    $nodes[] = $newAbstractPost;
                }
            }
        } else {
            $listProvider     = $this->branches->getFileListProvider();
            $dynamicProviders = $this->getDynamicFileProviders();

            /** @var DynamicFileProviderInterface $dynamicProvider */
            foreach ($dynamicProviders as $dynamicProvider) {
                $nodes = array_merge($nodes, $dynamicProvider->provide(new Url($url), $parentPost));
            }
        }

        return $listProvider->provide($nodes);
    }

    /**
     * Get post at $url.
     *
     * @param $url
     *
     * @return NodeInterface
     *
     * @throws NodeNotFoundException when node is not found
     */
    public function get($url)
    {
        $url      = new Url($url);
        $location = $this->branches->getUrlManager()->urlMatches($url);

        if ($location === false) {
            $resolution = new NotFoundResolution();
        } else {
            $url      = $location->getUrl();
            $realPath = $location->getPath();

            if (Branches::isDirectoryValid($realPath)) {
                $post       = $this->branches->getPostProvider()->provide($url, $realPath);
                $resolution = new PostResolution($post);
            } elseif (Branches::isFileValid($realPath)) {
                $file       = $this->branches->getFileProvider()->provide($url, $realPath);
                $resolution = new FileResolution($file);
            } else {
                $resolution = new NotFoundResolution();
            }
        }

        $result = $this->branches->getResolutionManager()->resolve($this->branches->getResolutionManager()->filterResolution($url, $resolution));

        if (is_null($result)) {
            throw new NodeNotFoundException($url);
        }

        return $result;
    }

    /**
     * @return ComponentHolder
     */
    public function getDynamicPostProviders()
    {
        return $this->branches->getExtensionManager()->collect(function (ExtensionInterface $extension, ComponentHolder $queue) {
            if ($extension instanceof DynamicNodeExtensionInterface) {
                $extension->getDynamicPostProviders($queue);
            }
        });
    }

    /**
     * @return ComponentHolder
     */
    public function getDynamicFileProviders()
    {
        return $this->branches->getExtensionManager()->collect(function (ExtensionInterface $extension, ComponentHolder $queue) {
            if ($extension instanceof DynamicNodeExtensionInterface) {
                $extension->getDynamicFileProviders($queue);
            }
        });
    }
}
